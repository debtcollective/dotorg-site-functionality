import { InnerBlocks, useBlockProps } from '@wordpress/block-editor';
import { __ } from '@wordpress/i18n';

import classNames from 'classnames';

//  Import CSS.
// import './editor.scss';
// import './style.scss';

const TEMPLATE = [
	[
		'core/paragraph',
		{
			placeholder: __( 'Add answer text...', 'site-functionality' ),
		},
		[],
	],
];

const ALLOWED_BLOCKS = [
	'core/heading',
	'core/paragraph',
	'core/buttons',
	'core/button'
];

const Edit = ( props ) => {
	const {
		attributes,
		className,
		setAttributes,
		clientId,
	} = props;

	const blockProps = useBlockProps( {
		className: classNames( className, 'faq__answer answer' ),
	} );

	return (
		<div { ...blockProps }>
			<div className='answer-wrapper'>
				<InnerBlocks
					allowedBlocks={ ALLOWED_BLOCKS }
					template={ TEMPLATE }
					templateLock={ false }
				/>
			</div>
		</div>
	);
};

export default Edit;
