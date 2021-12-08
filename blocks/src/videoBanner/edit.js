import { InnerBlocks, useBlockProps } from '@wordpress/block-editor';

import { __ } from '@wordpress/i18n';

import './editor.scss';

import classNames from 'classnames';

const TEMPLATE = [
	[ 'core/column', {
		verticalAlignment: 'top',
		className: 'video-banner__left'
	}, [
		[ 'core/embed', {
			type: "video",
			providerNameSlug: "youtube",
			responsive: true,
			className:"video-banner__media"
		} ]
	] ],
	[ 'core/column', {
		verticalAlignment: 'top',
		className: 'video-banner__right'
	}, [
		[ 'core/heading', {
			level: 3,
			className: 'video-banner__heading',
			placeholder: __( 'Add Heading...', 'site-functionality' )
		} ],
		[ 'core/paragraph', {
			className: 'video-banner__content',
			placeholder: __( 'Add content...', 'site-functionality' )
		} ]
	] ]
];

const ALLOWED_BLOCKS = [
	'core/columns',
	'core/column',
	'core/heading',
	'core/paragraph'
];

const Edit = ( props ) => {
	const { attributes, className } = props;

	const blockProps = useBlockProps( {
		className: classNames( className, 'video-banner' ),
	} );

	return (
		<div { ...blockProps }>
			<InnerBlocks
				allowedBlocks={ ALLOWED_BLOCKS }
				template={ TEMPLATE }
				templateLock="insert"
			/>
		</div>
	);
};

export default Edit;
