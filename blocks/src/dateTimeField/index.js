/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';

/**
 * Internal dependencies
 */
import metadata from './block.json';
import Edit from './edit';
import Save from './save';

const { name, category } = metadata;

const variations = [
	{
		name: 'date',
		title: 'Date',
		description: 'Display a date field',
		className: 'date',
		isDefault: true,
		attributes: {
			type: 'date',
			label: 'Date',
			placeholder: 'Add date...',
			format: 'l, F j, Y',
		},
		scope: [ 'inserter', 'block', 'transform' ],
		isActive: ( blockAttributes, variationAttributes ) =>
			blockAttributes.type === variationAttributes.type,
	},
	{
		name: 'time',
		title: 'Time',
		description: 'Display a time field',
		icon: 'clock',
		className: 'time',
		attributes: {
			type: 'time',
			label: 'Time',
			placeholder: 'Add time...',
			format: 'g:ia',
		},
		scope: ['inserter', 'block', 'transform'],
		isActive: ( blockAttributes, variationAttributes ) =>
			blockAttributes.type === variationAttributes.type,
	},
];

const settings = {
	edit: Edit,
	save: Save,
	variations,
};

export { name, category, settings };
