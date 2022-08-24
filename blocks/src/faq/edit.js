import { RichText, InnerBlocks, useBlockProps } from '@wordpress/block-editor';
import { __ } from '@wordpress/i18n';

import classNames from 'classnames';
import icon from './icon';

const TEMPLATE = [
	[
		'site-functionality/faq-question',
		{
			className: 'faq__question question',
		},
		[],
	],
	[
		'site-functionality/faq-answer',
		{
			className: 'faq__answer answer',
		},
		[
			[
				'core/paragraph',
				{
					placeholder: __( 'Add answer text...', 'site-functionality' ),
				},
				[]
			]
		],
	],
];

const ALLOWED_BLOCKS = [ 
	'site-functionality/faq-question',
	'site-functionality/faq-answer'
];


const Edit = ( props ) => {
	const {
		attributes: { anchor },
		className,
		context,
	} = props;

	const blockProps = useBlockProps( {
		className: classNames( className, 'faq' ),
	} );

	return (
		<article { ...blockProps }>
			<InnerBlocks
				allowedBlocks={ ALLOWED_BLOCKS }
				template={ TEMPLATE }
				templateLock='all'
			/>
		</article>
	);
};

export default Edit;
