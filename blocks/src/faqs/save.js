import { InnerBlocks, useBlockProps } from '@wordpress/block-editor';

import classNames from 'classnames';

const Save = ( props ) => {
	const { 
		attributes: { recordId, anchor },
		className,
		setAttributes,
		clientId
	} = props;
	const blockProps = useBlockProps.save( {
		className: classNames( className, 'faq-list' ),
		id: anchor ? anchor : recordId
	} );
	return (
		<div { ...blockProps }>
			<InnerBlocks.Content />
		</div>
	);
};

export default Save;
