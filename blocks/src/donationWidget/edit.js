import {
	useBlockProps,
} from '@wordpress/block-editor';
import { Button, PanelBody, PanelRow } from '@wordpress/components';
import { __ } from '@wordpress/i18n';

import { DonationWidget } from '@debtcollective/union-component';
import classNames from 'classnames';

const Edit = ( props ) => {
	const {
		attributes,
		className,
		setAttributes,
	} = props;

	const blockProps = useBlockProps( {
		className: classNames( className, 'donation-widget' ),
	} );

	return (
		<div { ...blockProps } >
			<DonationWidget />
		</div>
	);
};

export default Edit;
