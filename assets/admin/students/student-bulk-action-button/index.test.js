/**
 * External dependencies
 */
import { render, screen } from '@testing-library/react';
/**
 * Internal dependencies
 */
import { StudentBulkActionButton } from './index';
import nock from 'nock';

const ignoreInlineTags = ( value ) => ( _, node ) => {
	const hasText = ( n ) => n.textContent === value;
	const nodeHasText = hasText( node );
	const childrenDontHaveText = Array.from( node.children ).every(
		( child ) => ! hasText( child )
	);

	return nodeHasText && childrenDontHaveText;
};

let spy;
const courses = [
	{
		id: 1,
		title: { rendered: 'My Course' },
	},
];
const NOCK_HOST_URL = 'http://localhost';

// Create a bulk action selector with enrol student option selected.
beforeAll( () => {
	spy = jest.spyOn( document, 'getElementById' );
} );
describe( '<StudentBulkActionButton />', () => {
	const selectActionButton = () =>
		screen.getByRole( 'button', {
			name: 'Select Action',
		} );

	beforeAll( () => {
		nock( NOCK_HOST_URL )
			.persist()
			.get( '/wp-json/wp/v2/courses' )
			.query( { per_page: 100 } )
			.reply( 200, courses );
	} );

	it( 'Should render the `Add to course` modal', () => {
		setupSelector( [
			{ value: 'enrol_restore_enrolment', selected: true },
			{ value: 'remove_progress' },
			{ value: 'remove_enrolment' },
		] );
		render( <StudentBulkActionButton /> );

		selectActionButton().click();
		expect(
			screen.getByText(
				ignoreInlineTags(
					'Select the course(s) you would like to add 3 students to:'
				)
			)
		).toBeInTheDocument();
	} );

	it( 'Should render the `Reset or Remove Progress` modal', () => {
		setupSelector( [
			{ value: 'enrol_restore_enrolment' },
			{ value: 'remove_progress', selected: true },
			{ value: 'remove_enrolment' },
		] );
		render( <StudentBulkActionButton /> );

		selectActionButton().click();

		expect(
			screen.getByText(
				ignoreInlineTags(
					'Select the course(s) you would like to reset or remove progress from for 3 students:'
				)
			)
		).toBeInTheDocument();
	} );
	it( 'Should render the `Remove from Course` modal', () => {
		setupSelector( [
			{ value: 'enrol_restore_enrolment' },
			{ value: 'remove_progress' },
			{ value: 'remove_enrolment', selected: true },
		] );
		render( <StudentBulkActionButton /> );

		selectActionButton().click();
		expect(
			screen.getByText(
				ignoreInlineTags(
					'Select the course(s) you would like to remove 3 students from:'
				)
			)
		).toBeInTheDocument();
	} );
} );

/**
 *  Create selector element with options that are passed to the function.
 *
 * @param {Array} options Options to created selector with.
 */
const setupSelector = ( options ) => {
	const mockSelector = document.createElement( 'select' );
	mockSelector.id = 'bulk-action-selector-top';
	options.forEach( ( option ) => {
		const optionElement = document.createElement( 'option' );
		optionElement.value = option.value;

		if ( option.selected ) {
			optionElement.selected = option.selected;
		}

		mockSelector.appendChild( optionElement );
	} );

	const mockStudentIdContainer = document.createElement( 'input' );
	mockStudentIdContainer.id = 'bulk-action-user-ids';
	mockStudentIdContainer.value = '[1,2,3]';

	spy.mockImplementation( ( elementId ) => {
		return 'bulk-action-selector-top' === elementId
			? mockSelector
			: mockStudentIdContainer;
	} );
};
