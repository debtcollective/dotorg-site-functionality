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
		name: 'button-tout',
		title: __( 'Button Tout', 'site-functionality' ),
		category: 'components',
		description: __( 'Display a jade tout with button on page.', 'site-functionality' ),
		isDefault: true,
		attributes: {
			className: 'tout button-tout',
		},
		example: {
			attributes: {
				className: 'tout button-tout',
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
						className: 'tout__image',
						id: 134,
						sizeSlug: 'full',
						linkDestination: 'none',
					},
				},
				{
					name: 'core/button',
					attributes: {
						className: 'tout__button btn',
						content: __(
							"Button",
							'site-functionality'
						),
					},
				},
			],
		},
		scope: [ 'block', 'inserter', 'transform' ],
	},
	{
		name: 'button-tout-jade',
		title: __( 'Jade Button Tout', 'site-functionality' ),
		category: 'components',
		description: __( 'Display a jade tout with button on page.', 'site-functionality' ),
		attributes: {
			className: 'tout button-tout jade',
		},
		attributes: {
			className: 'tout button-tout jade',
		},
		example: {
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
						className: 'tout__image',
						id: 134,
						sizeSlug: 'full',
						linkDestination: 'none',
					},
				},
				{
					name: 'core/button',
					attributes: {
						className: 'tout__button btn',
						content: __(
							"Button",
							'site-functionality'
						),
					},
				},
			],
		},
		scope: [ 'block', 'inserter', 'transform' ],
	},
	{
		name: 'button-tout-salmon',
		title: __( 'Salmon Button Tout', 'site-functionality' ),
		category: 'components',
		description: __( 'Display a salmon tout with button on page.', 'site-functionality' ),
		attributes: {
			className: 'tout button-tout salmon',
		},
		example: {
			attributes: {
				className: 'tout button-tout salmon',
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
						className: 'tout__image',
						id: 134,
						sizeSlug: 'full',
						linkDestination: 'none',
					},
				},
				{
					name: 'core/button',
					attributes: {
						className: 'tout__button btn',
						content: __(
							"Button",
							'site-functionality'
						),
					},
				},
			],
		},
		scope: [ 'block', 'inserter', 'transform' ],
	},
	{
		name: 'button-tout-canary',
		title: __( 'Canary Button Tout', 'site-functionality' ),
		category: 'components',
		description: __( 'Display a canary tout with button on page.', 'site-functionality' ),
		attributes: {
			className: 'tout button-tout canary',
		},
		example: {
			attributes: {
				className: 'tout button-tout canary',
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
						className: 'tout__image',
						id: 134,
						sizeSlug: 'full',
						linkDestination: 'none',
					},
				},
				{
					name: 'core/button',
					attributes: {
						className: 'tout__button btn',
						content: __(
							"Button",
							'site-functionality'
						),
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
