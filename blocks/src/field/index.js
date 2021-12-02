/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { edit as icon } from '@wordpress/icons';

/**
 * Internal dependencies
 */
import metadata from './block.json';
import Edit from './edit';
import Save from './save';

const { name, category } = metadata;

const variations = [
	{
		name: "text",
		title: "Text",
		description: "Display a text field",
		className: "text",
		isDefault: true,
		attributes: {
			type: "text",
			label: "Text",
			placeholder: "Add text..."
		},
		scope: [
			'inserter',
			'block',
			'transform'
		]
	},
	{
		name: "date",
		title: "Date",
		description: "Display a date field",
		icon: "calendar-alt",
		className: "date",
		attributes: {
			type: "date",
			label: "Date",
			placeholder: "Add date..."
		},
		scope: [
			'inserter',
			'block',
			'transform'
		]
	},
	{
		name: "time",
		title: "Time",
		description: "Display a time field",
		icon: "clock",
		className: "time",
		attributes: {
			type: "time",
			label: "Time",
			placeholder: "Add time..."
		},
		scope: [
			'inserter',
			'block',
			'transform'
		]
	},
	{
		name: "email",
		title: "Email",
		description: "Display a email field",
		icon: "email-alt",
		className: "email",
		attributes: {
			type: "email",
			label: "Email",
			placeholder: "Add email..."
		},
		scope: [
			'inserter',
			'block',
			'transform'
		]
	},
	{
		name: "url",
		title: "URL",
		description: "Display a url field",
		icon: "admin-site-alt3",
		className: "url",
		attributes: {
			type: "url",
			label: "URL",
			placeholder: "Add URL..."
		},
		scope: [
			'inserter',
			'block',
			'transform'
		]
	},
	{
		name: "tel",
		title: "Telephone",
		description: "Display a telephone field",
		icon: "phone",
		className: "tel",
		attributes: {
			type: "tel",
			label: "Telephone",
			placeholder: "Add telephone..."
		},
		scope: [
			'inserter',
			'block',
			'transform'
		]
	},
	{
		name: "number",
		title: "Number",
		description: "Display a number field",
		icon: "editor-ol",
		className: "number",
		attributes: {
			type: "number",
			label: "Number",
			placeholder: "Add number..."
		},
		scope: [
			'inserter',
			'block',
			'transform'
		]
	}
];

const settings = {
	icon,
	edit: Edit,
	save: Save,
	variations
};

export { name, category, settings };
