/**
 * WordPress dependencies
 */
import {
	useBlockProps,
	store as blockEditorStore
} from '@wordpress/block-editor';
import {
	SelectControl,
	Spinner,
	ToggleControl
} from '@wordpress/components';
import { useSelect } from '@wordpress/data';
import { __ } from '@wordpress/i18n';

//  Import CSS.
import './editor.scss';
// import './style.scss';

const Edit = ( props ) => {
	const {
		attributes: { taxonomy, label, term, isLinked },
		isSelected,
		onReplace,
		setAttributes,
		className,
	} = props;

	const blockProps = useBlockProps();

	const setTerm = ( value ) => {
		setAttributes( {
			term: value
		} );

		// console.log( value );
	};

	const setIsLinked = ( value ) => {
		setAttributes( {
			isLinked: value
		} );

		// console.log( isLinked );
	};

	const TermSelector = () => {		
		const terms = useSelect( ( select ) => {
			return select( 'core' ).getEntityRecords( 'taxonomy', taxonomy );
		}, [] );

		if ( ! terms || ! terms.length ) {
			return <Spinner />;
		}

		const options = terms.map( ( { id, name } ) => ( {
			value: id,
			label: name,
		} ) );

		return (
			<>
				<SelectControl
					label={ label }
					options={ [
						{
							value: '',
							label: __( 'Select a ' + label, 'site-functionality' ),
						},
						...options,
					] }
					onChange={ setTerm }
					value={ term }
				/>
			</>
		);
	};

	const ToggleSelector = () => {
	
		return (
			<ToggleControl
				label={ __( 'Link to Term', 'site-functionality' ) }
				// help={
				// 	isLinked
				// 		? 'Is Linked to Term.'
				// 		: 'Is Not Linked to Term.'
				// }
				checked={ isLinked }
				onChange={ setIsLinked }
			/>
		);
	};

	return (
		<div {...blockProps}>
			{ console.log( term, isLinked ) }
			<div><TermSelector /></div>
			<div><ToggleSelector /></div>
		</div>
	);
};

export default Edit;
