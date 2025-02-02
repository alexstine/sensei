<?php
/**
 * Student Sends Message email pattern.
 *
 * @package sensei
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>

<!-- wp:group {"style":{"spacing":{"padding":{"top":"40px","right":"56px","left":"56px","bottom":"48px"}},"color":{"background":"#ffffff"}},"className":"email-notification__content"} -->
<div class="wp-block-group email-notification__content has-background" style="background-color:#ffffff;padding-top:40px;padding-right:56px;padding-bottom:48px;padding-left:56px"><!-- wp:post-title {"style":{"typography":{"textTransform":"capitalize","fontStyle":"normal","fontWeight":"700","fontSize":"40px","lineHeight":1.2},"color":{"text":"#101517"},"spacing":{"padding":{"top":"0px","right":"0px","bottom":"0px","left":"0px"},"margin":{"top":"0px","right":"0px","bottom":"0px","left":"0px"}}}} /-->

	<!-- wp:group {"style":{"color":{"background":"#f6f7f7"},"spacing":{"padding":{"top":"32px","right":"32px","bottom":"53px","left":"32px"},"margin":{"top":"48px","bottom":"0px"},"blockGap":"0px"}}} -->
	<div class="wp-block-group has-background" style="background-color:#f6f7f7;margin-top:48px;margin-bottom:0px;padding-top:32px;padding-right:32px;padding-bottom:53px;padding-left:32px"><!-- wp:paragraph {"style":{"typography":{"fontSize":"32px"},"spacing":{"padding":{"top":"0px","right":"0px","bottom":"0px","left":"0px"},"margin":{"top":"0px","right":"0px","bottom":"0px","left":"0px"}},"color":{"text":"#101517"}}} -->
		<p class="has-text-color" style="color:#101517;margin-top:0px;margin-right:0px;margin-bottom:0px;margin-left:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;font-size:32px"><strong>[student:displayname]</strong></p>
		<!-- /wp:paragraph -->

		<!-- wp:paragraph {"style":{"typography":{"fontSize":"16px"},"spacing":{"margin":{"top":"24px","bottom":"0px"}},"color":{"text":"#101517"}}} -->
		<p class="has-text-color" style="color:#101517;font-size:16px;margin-top:24px;margin-bottom:0px"><strong>Course Name</strong></p>
		<!-- /wp:paragraph -->

		<!-- wp:paragraph {"style":{"typography":{"fontSize":"16px"},"color":{"text":"#101517"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
		<p class="has-text-color" style="color:#101517;font-size:16px;margin-top:0;margin-bottom:0">[course:name]</p>
		<!-- /wp:paragraph -->

		<!-- wp:paragraph {"style":{"typography":{"fontSize":"16px"},"spacing":{"margin":{"top":"24px","bottom":"0px"}},"color":{"text":"#101517"}}} -->
		<p class="has-text-color" style="color:#101517;font-size:16px;margin-top:24px;margin-bottom:0px"><strong>Message Content</strong></p>
		<!-- /wp:paragraph -->

		<!-- wp:paragraph {"style":{"typography":{"fontSize":"16px"},"color":{"text":"#101517"},"spacing":{"margin":{"top":"0","bottom":"24px"}}}} -->
		<p class="has-text-color" style="color:#101517;font-size:16px;margin-top:0;margin-bottom:24px">[subject:displaysubject]</p>
		<!-- /wp:paragraph -->

		<!-- wp:paragraph {"style":{"typography":{"fontSize":"16px"},"color":{"text":"#101517"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
		<p class="has-text-color" style="color:#101517;font-size:16px;margin-top:0;margin-bottom:0">[message:displaymessage]</p>
		<!-- /wp:paragraph -->

		<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"40px","bottom":"20px"}}}} -->
		<div class="wp-block-buttons" style="margin-top:40px;margin-bottom:20px"><!-- wp:button {"style":{"color":{"background":"#101517","text":"#fefefe"},"typography":{"fontSize":"16px"}},"className":"has-custom-font-size"} -->
			<div class="wp-block-button has-custom-font-size" style="font-size:16px"><a class="wp-block-button__link has-text-color has-background" href="[reply:url]" style="color:#fefefe;background-color:#101517">Reply Here</a></div>
			<!-- /wp:button -->
		</div>
		<!-- /wp:buttons -->

		<!-- wp:paragraph {"style":{"color":{"text":"#101517"},"typography":{"fontSize":"16px"}},"className":"info__extra"} -->
		<p class="info__extra has-text-color" style="color:#101517;font-size:16px">You can also reply directly by email, but the response will not be logged in the course.</p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
