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

const variations = [
	{
		name: 'tout-jade',
		title: __( 'Jade Tout', 'site-functionality' ),
		category: 'components',
		description: __( 'Display a jade tout on page.', 'site-functionality' ),
		keywords: [
			__( 'tout', 'site-functionality' ),
			__( 'call to action', 'site-functionality' ),
			__( 'callout', 'site-functionality' ),
		],
		attributes: {
			className: 'tout jade',
		},
		example: {
			attributes: {
				className: 'tout jade',
			},
			innerBlocks: [
				{
					name: 'core/heading',
					attributes: {
						level: 2,
						className: 'tout__heading',
						content: __(
							'Alone our debts are a burden.<br /> Together they make us <em>powerful</em>.',
							'site-functionality'
						),
					},
				},
				{
					name: 'core/paragraph',
					attributes: {
						className: 'tout__content',
						content: __(
							"We are a debtors' union fighting to cancel debts and defend millions of households. Join us to build a world where college is publicly funded, healthcare is universal and housing is guaranteed for all.",
							'site-functionality'
						),
					},
				},
				{
					name: 'core/image',
					attributes: {
						className: 'tout__image btn',
						id: 134,
						sizeSlug: 'full',
						linkDestination: 'none',
					},
				},
			],
		},
		scope: [ 'block', 'inserter', 'transform' ],
	},
	{
		name: 'tout-canary',
		title: __( 'Canary Tout', 'site-functionality' ),
		category: 'components',
		description: __(
			'Display a canary tout on page.',
			'site-functionality'
		),
		keywords: [
			__( 'tout', 'site-functionality' ),
			__( 'call to action', 'site-functionality' ),
			__( 'callout', 'site-functionality' ),
		],
		attributes: {
			className: 'tout canary',
		},
		example: {
			attributes: {
				className: 'tout canary',
			},
			innerBlocks: [
				{
					name: 'core/heading',
					attributes: {
						level: 2,
						className: 'tout__heading',
						content: __(
							'Alone our debts are a burden.<br /> Together they make us <em>powerful</em>.',
							'site-functionality'
						),
					},
				},
				{
					name: 'core/paragraph',
					attributes: {
						className: 'tout__content',
						content: __(
							"We are a debtors' union fighting to cancel debts and defend millions of households. Join us to build a world where college is publicly funded, healthcare is universal and housing is guaranteed for all.",
							'site-functionality'
						),
					},
				},
				{
					name: 'core/image',
					attributes: {
						className: 'tout__image btn',
						id: 134,
						sizeSlug: 'full',
						linkDestination: 'none',
					},
				},
			],
		},
		scope: [ 'block', 'inserter', 'transform' ],
	},
	{
		name: 'tout-salmon',
		title: __( 'Salmon Tout', 'site-functionality' ),
		category: 'components',
		description: __(
			'Display a salmon tout on page.',
			'site-functionality'
		),
		keywords: [
			__( 'tout', 'site-functionality' ),
			__( 'call to action', 'site-functionality' ),
			__( 'callout', 'site-functionality' ),
		],
		attributes: {
			className: 'tout salmon',
		},
		example: {
			attributes: {
				className: 'tout salmon',
			},
			innerBlocks: [
				{
					name: 'core/heading',
					attributes: {
						level: 2,
						className: 'tout__heading',
						content: __(
							'Alone our debts are a burden.<br /> Together they make us <em>powerful</em>.',
							'site-functionality'
						),
					},
				},
				{
					name: 'core/paragraph',
					attributes: {
						className: 'tout__content',
						content: __(
							"We are a debtors' union fighting to cancel debts and defend millions of households. Join us to build a world where college is publicly funded, healthcare is universal and housing is guaranteed for all.",
							'site-functionality'
						),
					},
				},
				{
					name: 'core/image',
					attributes: {
						className: 'tout__image btn',
						id: 134,
						sizeSlug: 'full',
						linkDestination: 'none',
					},
				},
			],
		},
		scope: [ 'block', 'inserter', 'transform' ],
	},
];

const settings = {
	icon,
	edit: Edit,
	save: Save,
	variations
};

export { name, category, settings };
