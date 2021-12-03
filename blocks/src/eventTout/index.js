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
import { postDate as icon } from '@wordpress/icons';

const { name, category } = metadata;

const settings = {
	icon,
	edit: Edit,
	save: Save,
};

export { name, category, settings };
