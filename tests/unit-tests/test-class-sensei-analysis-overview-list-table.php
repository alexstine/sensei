<?php

/**
 * Tests for Sensei_Analysis_Overview_List_Table class.
 */
class Sensei_Analysis_Overview_List_Table_Test extends WP_UnitTestCase {

	/**
	 * Set up before each test.
	 */
	public function setup() {
		parent::setUp();

		$this->factory = new Sensei_Factory();
	}

	/**
	 * Tear down after each test.
	 */
	public function tearDown() {
		parent::tearDown();

		$this->factory->tearDown();
	}

	/**
	 * Lesson statuses that mark the lesson as completed.
	 *
	 * @return string[][]
	 */
	public function lessonCompleteStatuses(): array {
		return [
			[ 'complete' ],
			[ 'passed' ],
			[ 'graded' ],
		];
	}

	/**
	 * Lesson statuses that mark the lesson as uncompleted.
	 *
	 * @return string[][]
	 */
	public function lessonIncompleteStatuses(): array {
		return [
			[ 'in-progress' ],
			[ 'ungraded' ],
			[ 'failed' ],
		];
	}

	/**
	 * Tests that the last activity is ignoring uncompleted lessons.
	 *
	 * @covers Sensei_Admin::get_last_activity_date
	 * @dataProvider lessonIncompleteStatuses
	 */
	public function testGetLastActivityDateShouldIgnoreIncompleteLessons( $lesson_incomplete_status ) {
		/* Arrange. */
		$user_id   = $this->factory->user->create();
		$lesson_id = $this->factory->lesson->create(
			[ 'meta_input' => [ '_lesson_course' => $this->factory->course->create() ] ]
		);

		$instance = new Sensei_Analysis_Overview_List_Table();
		$method   = new ReflectionMethod( $instance, 'get_last_activity_date' );
		$method->setAccessible( true );

		/* Act. */
		// Start lesson 1 (status: in-progress).
		$lesson_activity_comment_id = Sensei_Utils::sensei_start_lesson( $lesson_id, $user_id );
		wp_update_comment(
			[
				'comment_ID'       => $lesson_activity_comment_id,
				'comment_approved' => $lesson_incomplete_status,
			]
		);

		/* Assert. */
		$this->assertEquals(
			'N/A',
			$method->invoke( $instance, array( 'user_id' => $user_id ) ),
			'The last activity should not take into account lessons that are in progress.'
		);
	}

	/**
	 * Tests that the last activity is based on "completed" lessons.
	 *
	 * @covers Sensei_Admin::get_last_activity_date
	 * @dataProvider lessonCompleteStatuses
	 */
	public function testGetLastActivityDateShouldBeBasedOnCompletedLessons( $lesson_complete_status ) {
		/* Arrange. */
		$user_id   = $this->factory->user->create();
		$lesson_id = $this->factory->lesson->create(
			[ 'meta_input' => [ '_lesson_course' => $this->factory->course->create() ] ]
		);

		$instance = new Sensei_Analysis_Overview_List_Table();
		$method   = new ReflectionMethod( $instance, 'get_last_activity_date' );
		$method->setAccessible( true );

		/* Act. */
		$lesson_activity_comment_id = Sensei_Utils::sensei_start_lesson( $lesson_id, $user_id );
		wp_update_comment(
			[
				'comment_ID'       => $lesson_activity_comment_id,
				'comment_approved' => $lesson_complete_status,
			]
		);

		/* Assert. */
		$this->assertStringEndsWith(
			'ago',
			$method->invoke( $instance, array( 'user_id' => $user_id ) ),
			'The last activity should take into account lessons with status "' . $lesson_complete_status . '".'
		);
	}

	/**
	 * Tests that the last activity should be the more recent one.
	 *
	 * @covers Sensei_Admin::get_last_activity_date
	 */
	public function testGetLastActivityDateShouldReturnTheMoreRecentActivity() {
		/* Arrange. */
		$user_id   = $this->factory->user->create();
		$course_id = $this->factory->course->create();
		$lesson_1  = $this->factory->lesson->create(
			[ 'meta_input' => [ '_lesson_course' => $course_id ] ]
		);
		$lesson_2  = $this->factory->lesson->create(
			[ 'meta_input' => [ '_lesson_course' => $course_id ] ]
		);

		$instance = new Sensei_Analysis_Overview_List_Table();
		$method   = new ReflectionMethod( $instance, 'get_last_activity_date' );
		$method->setAccessible( true );

		/* Act. */
		// Complete lesson 1 and update its activity date.
		$lesson_1_activity_comment_id = Sensei_Utils::sensei_start_lesson( $lesson_1, $user_id, true );
		$lesson_1_activity_timestamp  = strtotime( '-3 days' );
		wp_update_comment(
			[
				'comment_ID'   => $lesson_1_activity_comment_id,
				'comment_date' => gmdate( 'Y-m-d H:i:s', $lesson_1_activity_timestamp ),
			]
		);

		// Complete lesson 2 and update its activity date.
		$lesson_2_activity_comment_id = Sensei_Utils::sensei_start_lesson( $lesson_2, $user_id, true );
		$lesson_2_activity_timestamp  = strtotime( '-2 day' );
		wp_update_comment(
			[
				'comment_ID'   => $lesson_2_activity_comment_id,
				'comment_date' => gmdate( 'Y-m-d H:i:s', $lesson_2_activity_timestamp ),
			]
		);

		/* Assert. */
		$this->assertEquals(
			'2 days ago',
			$method->invoke( $instance, array( 'user_id' => $user_id ) ),
			'The last activity should be the more recent activity.'
		);

		/* Act. */
		// Update lesson 1 activity date.
		$lesson_1_activity_timestamp = strtotime( '-1 days' );
		wp_update_comment(
			[
				'comment_ID'   => $lesson_1_activity_comment_id,
				'comment_date' => gmdate( 'Y-m-d H:i:s', $lesson_1_activity_timestamp ),
			]
		);

		/* Assert. */
		$this->assertEquals(
			'1 day ago',
			$method->invoke( $instance, array( 'user_id' => $user_id ) ),
			'The last activity should be the more recent activity.'
		);
	}

	/**
	 * Tests that the last activity date format is human-readable when less than a week.
	 *
	 * @covers Sensei_Admin::get_last_activity_date
	 */
	public function testGetLastActivityDateShouldUseHumanReadableTimeFormatIfLessThanAWeek() {
		/* Arrange. */
		$user_id   = $this->factory->user->create();
		$lesson_id = $this->factory->lesson->create(
			[ 'meta_input' => [ '_lesson_course' => $this->factory->course->create() ] ]
		);

		$instance = new Sensei_Analysis_Overview_List_Table();
		$method   = new ReflectionMethod( $instance, 'get_last_activity_date' );
		$method->setAccessible( true );

		/* Act. */
		// Complete lesson and update its activity date.
		$lesson_activity_comment_id = Sensei_Utils::sensei_start_lesson( $lesson_id, $user_id, true );
		$lesson_activity_timestamp  = strtotime( '-7 days' );
		wp_update_comment(
			[
				'comment_ID'   => $lesson_activity_comment_id,
				'comment_date' => gmdate( 'Y-m-d H:i:s', $lesson_activity_timestamp ),
			]
		);

		/* Assert. */
		$this->assertEquals(
			wp_date(
				get_option( 'date_format' ),
				$lesson_activity_timestamp,
				new DateTimeZone( 'GMT' )
			),
			$method->invoke( $instance, array( 'user_id' => $user_id ) ),
			'The last activity date format or timezone is invalid.'
		);

		/* Act. */
		// Update the lesson's activity date.
		$lesson_activity_timestamp = strtotime( '-1 day' );
		wp_update_comment(
			[
				'comment_ID'   => $lesson_activity_comment_id,
				'comment_date' => gmdate( 'Y-m-d H:i:s', $lesson_activity_timestamp ),
			]
		);

		/* Assert. */
		$this->assertEquals(
			'1 day ago',
			$method->invoke( $instance, array( 'user_id' => $user_id ) ),
			'The last activity date format should be in human-readable form.'
		);
	}

	/**
	 * Tests that the correct last activity date is returned when queried by course.
	 *
	 * @covers Sensei_Admin::get_last_activity_date
	 */
	public function testGetLastActivityDateByCourseLessons() {
		$user_ids   = $this->factory->user->create_many( 3 );
		$lesson_ids = $this->factory->lesson->create_many(
			2,
			[ 'meta_input' => [ '_lesson_course' => $this->factory->course->create() ] ]
		);
		$days_count = -7;

		$instance = new Sensei_Analysis_Overview_List_Table();
		$method   = new ReflectionMethod( $instance, 'get_last_activity_date' );
		$method->setAccessible( true );

		// Complete a lesson for each student on a different date.
		foreach ( $user_ids as $user_id ) {
			$lesson_activity_comment_id = Sensei_Utils::sensei_start_lesson( $lesson_ids[0], $user_id, true );
			wp_update_comment(
				[
					'comment_ID'   => $lesson_activity_comment_id,
					'comment_date' => gmdate( 'Y-m-d H:i:s', strtotime( $days_count . ' days' ) ),
				]
			);

			$days_count--;
		}

		$this->assertEquals(
			wp_date(
				get_option( 'date_format' ),
				strtotime( '-7 days' ),
				new DateTimeZone( 'GMT' )
			),
			$method->invoke( $instance, array( 'post__in' => $lesson_ids ) ),
			'The last activity date format or timezone is invalid.'
		);
	}

	public function testAddDaysToCompletionToCoursesQueriesWithProvidedClausesModifiesQueryParts() {
		$instance = new Sensei_Analysis_Overview_List_Table();

		$actual = $instance->add_days_to_completion_to_courses_queries(
			[
				'fields'  => 'a',
				'join'    => 'b',
				'where'   => 'c',
				'groupby' => 'd',
			]
		);

		$expected = [
			'fields'  => "a, SUM(  ABS( DATEDIFF( wptests_comments.comment_date, STR_TO_DATE( wptests_commentmeta.meta_value, '%Y-%m-%d %H:%i:%s' ) ) ) + 1 ) AS days_to_completion, COUNT(wptests_commentmeta.comment_id) AS count_of_completions",
			'join'    => "b LEFT JOIN wptests_comments ON wptests_comments.comment_post_ID = wptests_posts.ID AND wptests_comments.comment_type IN ('sensei_course_status') AND wptests_comments.comment_approved IN ( 'complete' ) AND wptests_comments.comment_post_ID = wptests_posts.ID LEFT JOIN wptests_commentmeta ON wptests_comments.comment_ID = wptests_commentmeta.comment_id AND wptests_commentmeta.meta_key = 'start'",
			'where'   => 'c',
			'groupby' => 'd wptests_posts.ID',
		];

		self::assertSame( $expected, $actual );
	}

	public function testGetCoursesWithDaysToCompletionFiltersAppliedItemsHaveDaysToCompletionProperty() {
		$user_id   = $this->factory->user->create();
		$course_id = $this->factory->course->create();

		$comment_id = Sensei_Utils::update_course_status( $user_id, $course_id, 'complete' );
		update_comment_meta( $comment_id, 'start', '2022-01-01 00:00:01' );

		$instance    = new Sensei_Analysis_Overview_List_Table();
		$get_courses = new ReflectionMethod( $instance, 'get_courses' );
		$get_courses->setAccessible( true );

		$courses = $get_courses->invoke(
			$instance,
			[
				'number'  => 1,
				'offset'  => 0,
				'orderby' => '',
				'order'   => 'ASC',
			]
		);

		self::assertObjectHasAttribute( 'days_to_completion', $courses[0] );
	}

	public function testGetCoursesWithDaysToCompletionFiltersAppliedItemsHaveCountOfCompletionsProperty() {
		$user_id   = $this->factory->user->create();
		$course_id = $this->factory->course->create();

		$comment_id = Sensei_Utils::update_course_status( $user_id, $course_id, 'complete' );
		update_comment_meta( $comment_id, 'start', '2022-01-01 00:00:01' );

		$instance    = new Sensei_Analysis_Overview_List_Table();
		$get_courses = new ReflectionMethod( $instance, 'get_courses' );
		$get_courses->setAccessible( true );

		$courses = $get_courses->invoke(
			$instance,
			[
				'number'  => 1,
				'offset'  => 0,
				'orderby' => '',
				'order'   => 'ASC',
			]
		);

		self::assertObjectHasAttribute( 'count_of_completions', $courses[0] );
	}
}
