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
import icon from './icon';

const { name, category } = metadata;

const variations = [];

const settings = {
	icon,
	edit: Edit,
	save: Save,
	variations
};

export { name, category, settings };
