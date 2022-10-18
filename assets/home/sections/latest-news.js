/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';

/**
 * Internal dependencies
 */
import Section from '../section';
import Link from '../link';
import { decodeEntities } from '@wordpress/html-entities';

/**
 * Latest News section component.
 *
 * @param {Object} props
 * @param {Object} props.data
 */
const LatestNews = ( { data } ) => {
	if ( ! data ) {
		return null;
	}

	return (
		<Section
			title={ __( 'Latest News', 'sensei-lms' ) }
			className="sensei-home__latest-news"
		>
			<ul>
				{ data.items.map( ( item, key ) => (
					<li key={ key }>
						<Link
							label={ decodeEntities( item.title ) }
							url={ item.url }
						/>
						<div className="sensei-home__latest-news__date">
							{ decodeEntities( item.date ) }
						</div>
					</li>
				) ) }
			</ul>
			{ data.more_url && (
				<div className="sensei-home__guides__more-link">
					<Link
						label={ __( 'See more', 'sensei-lms' ) }
						url={ data.more_url }
					/>
				</div>
			) }
		</Section>
	);
};

export default LatestNews;
