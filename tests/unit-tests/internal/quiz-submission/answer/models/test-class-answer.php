<?php
/**
 * File containing the Answer_Test class.
 */

namespace SenseiTest\Internal\Quiz_Submission\Answer\Models;

use Sensei\Internal\Quiz_Submission\Answer\Models\Answer;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Answer_Test.
 *
 * @covers \Sensei\Internal\Quiz_Submission\Answer\Models\Answer
 */
class Answer_Test extends \WP_UnitTestCase {

	public function testGetId_ConstructedWithId_ReturnsSameId(): void {
		/* Arrange. */
		$answer = $this->createAnswer();

		/* Act. */
		$actual = $answer->get_id();

		/* Assert. */
		self::assertSame( 1, $actual );
	}

	public function testGetSubmissionId_ConstructedWithSubmissionId_ReturnsSameSubmissionId(): void {
		/* Arrange. */
		$answer = $this->createAnswer();

		/* Act. */
		$actual = $answer->get_submission_id();

		/* Assert. */
		self::assertSame( 2, $actual );
	}

	public function testGetQuestionId_ConstructedWithQuestionId_ReturnsSameQuestionId(): void {
		/* Arrange. */
		$answer = $this->createAnswer();

		/* Act. */
		$actual = $answer->get_question_id();

		/* Assert. */
		self::assertSame( 3, $actual );
	}

	public function testGetValue_ConstructedWithValue_ReturnsSameValue(): void {
		/* Arrange. */
		$answer = $this->createAnswer();

		/* Act. */
		$actual = $answer->get_value();

		/* Assert. */
		self::assertSame( 'yes', $actual );
	}

	public function testGetCreatedAt_ConstructedWithCreatedAt_ReturnsSameCreatedAt(): void {
		/* Arrange. */
		$answer = $this->createAnswer();

		/* Act. */
		$actual = $answer->get_created_at()->format( 'Y-m-d H:i:s' );

		/* Assert. */
		self::assertSame( '2020-01-01 00:00:01', $actual );
	}

	public function testGetUpdatedAt_ConstructedWithUpdatedAt_ReturnsSameUpdatedAt(): void {
		/* Arrange. */
		$answer = $this->createAnswer();

		/* Act. */
		$actual = $answer->get_updated_at()->format( 'Y-m-d H:i:s' );

		/* Assert. */
		self::assertSame( '2020-01-01 00:00:02', $actual );
	}

	private function createAnswer(): Answer {
		return new Answer(
			1,
			2,
			3,
			'yes',
			new \DateTime( '2020-01-01 00:00:01' ),
			new \DateTime( '2020-01-01 00:00:02' )
		);
	}
}
