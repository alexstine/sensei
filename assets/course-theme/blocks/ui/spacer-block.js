/**
 * WordPress dependencies
 */
import { useBlockProps } from '@wordpress/block-editor';
import { __ } from '@wordpress/i18n';
import { Icon, resizeCornerNE as spacerIcon } from '@wordpress/icons';

/**
 * Factory function for generating the edit/save components of the spacer block.
 *
 * @param {Function} blockPropsFn useBlockProps|useBlockProps.save
 * @return {Function} Block edit/save component.
 */
const SpacerBlock = ( blockPropsFn ) => () => {
	return (
		<div
			{ ...blockPropsFn( {
				className: 'sensei-course-theme__spacer-flex',
			} ) }
		/>
	);
};

/**
 * Spacer block that fills available space in flex containers.
 */
export default {
	name: 'sensei-lms/spacer-flex',
	title: __( 'Spacer (Auto)', 'sensei-lms' ),
	scope: [ 'inserter' ],
	apiVersion: 2,
	icon: {
		src: <Icon icon={ spacerIcon } />,
		foreground: '#43AF99',
	},
	description: __( 'Automatically fill space between blocks.', 'sensei-lms' ),
	attributes: {},
	edit: SpacerBlock( useBlockProps ),
	save: SpacerBlock( useBlockProps.save ),
};
