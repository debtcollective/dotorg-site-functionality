/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { tag as icon, category as cat } from '@wordpress/icons';

/**
 * Internal dependencies
 */
import metadata from './block.json';
import Edit from './edit';
import Save from './save';

const { name, category } = metadata;

const variations = [
	{
		name: 'post-tag',
		title: 'Tag',
		description: 'Display a tag.',
		className: 'tag',
		attributes: {
			taxonomy: 'post_tag',
			label: 'Tag',
		},
		scope: [ 'inserter', 'block', 'transform' ],
	},
	{
		name: 'event-tag',
		title: 'Event Tag',
		description: 'Display an event tag.',
		className: 'tag event-tag',
		isDefault: true,
		attributes: {
			taxonomy: 'event_tag',
			label: 'Tag',
		},
		scope: [ 'inserter', 'block', 'transform' ],
	},
	{
		name: 'category',
		title: 'Category',
		description: 'Display a category term.',
		icon: cat,
		className: 'tag category',
		attributes: {
			taxonomy: 'category',
			label: 'Category',
		},
		scope: [ 'inserter', 'block', 'transform' ],
	},
];

const settings = {
	icon,
	edit: Edit,
	save: Save,
	variations,
};

export { name, category, settings };
