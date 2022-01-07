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
		name: 'sidebar-links',
		title: __( 'Sidebar Links', 'site-functionality' ),
		category: 'widgets',
		description: __( 'Display a group of links with default jade background.', 'site-functionality' ),
		isDefault: true,
		keywords: [
			__( 'widget', 'site-functionality' ),
			__( 'link', 'site-functionality' ),
			__( 'sidebar', 'site-functionality' ),
		],
		attributes: {
			className: 'sidebar-links',
		},
		example: {
			attributes: {
				className: 'sidebar-links',
			},
			innerBlocks: [
				{
					name: 'site-functionality/sidebar-link'
				}
			],
		},
		scope: [ 'block', 'inserter', 'transform' ],
	},
	{
		name: 'sidebar-links-emphasis',
		title: __( 'Sidebar Links - Emphasis', 'site-functionality' ),
		description: __( 'Display a group of links with orange background.', 'site-functionality' ),
		attributes: {
			className: 'sidebar-links emphasis',
		},
		example: {
			attributes: {
				className: 'sidebar-links emphasis',
			},
			innerBlocks: [
				{
					name: 'site-functionality/sidebar-link'
				}
			],
		},
		scope: [ 'transform' ],
	},
	{
		name: 'sidebar-links-salmon',
		title: __( 'Sidebar Links - Salmon', 'site-functionality' ),
		description: __( 'Display a group of links with salmon background.', 'site-functionality' ),
		attributes: {
			className: 'sidebar-links salmon',
		},
		example: {
			attributes: {
				className: 'sidebar-links salmon',
			},
			innerBlocks: [
				{
					name: 'site-functionality/sidebar-link'
				}
			],
		},
		scope: [ 'transform' ],
	},
	{
		name: 'sidebar-links-canary',
		title: __( 'Sidebar Links - Canary', 'site-functionality' ),
		description: __( 'Display a group of links with canary background.', 'site-functionality' ),
		attributes: {
			className: 'sidebar-links canary',
		},
		example: {
			attributes: {
				className: 'sidebar-links canary',
			},
			innerBlocks: [
				{
					name: 'site-functionality/sidebar-link'
				}
			],
		},
		scope: [ 'transform' ],
	},
];


const settings = {
	edit: Edit,
	save: Save,
	variations
};

export { name, category, settings };
