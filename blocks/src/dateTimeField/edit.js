/**
 * WordPress Dependencies
 */
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import {
	CustomSelectControl,
	DateTimePicker,
	DatePicker,
	TimePicker,
	Popover,
	Button,
	SelectControl,
	TextControl,
	Panel,
	PanelBody,
	PanelRow,
} from '@wordpress/components';
import {
	useEntityProp,
	__experimentalUseInnerBlocksProps as useInnerBlocksProps,
	store as coreStore,
} from '@wordpress/core-data';
import { useState, useEffect } from '@wordpress/element';
import {
	__experimentalGetSettings as getDateSettings,
	dateI18n,
} from '@wordpress/date';
import { __ } from '@wordpress/i18n';

import classNames from 'classnames';

//  Import CSS.
import './editor.scss';
// import './style.scss';

const Edit = ( props ) => {
	const {
		attributes: { date, format, type, label, placeholder },
		isSelected,
		onReplace,
		setAttributes,
		className,
	} = props;

	const [ siteDateFormat ] = useEntityProp( 'root', 'site', 'date_format' );
	const [ siteTimeFormat ] = useEntityProp( 'root', 'site', 'time_format' );
	const settings = getDateSettings();
	const resolvedDateFormat =
		format || siteDateFormat || settings.formats.date;
	const resolvedTimeFormat =
		format || siteTimeFormat || settings.formats.time;

	const dateFormatOptions = () => {
		const date = new Date();
		let formats = [
			'D, M j',
			'l, F j, Y',
			'D, M j, Y',
			'F j, Y',
			'M j, Y',
			'm/j/Y',
		];
		const options = formats
			.filter( ( format ) => format !== settings.formats.date )
			.concat( [ settings.formats.date ] )
			.map( ( format ) => ( {
				key: format,
				name: dateI18n( format, date ),
			} ) );

		return options;
	};

	const timeFormatOptions = () => {
		const date = new Date();
		let formats = [ 'g:i a', 'g:i A', 'g:ia', 'H:i' ];
		const options = formats
			.filter( ( format ) => format !== settings.formats.time )
			.concat( [ settings.formats.time ] )
			.map( ( format ) => ( {
				key: format,
				name: dateI18n( format, date ),
			} ) );

		return options;
	};

	const setDateTime = ( value ) => {
		setAttributes( {
			date: value,
		} );
	};

	const setFormat = ( value ) => {
		setAttributes( {
			format: value.selectedItem.key,
		} );
		// console.log( value );
	};

	const DateSelector = () => {
		const [ isDatePopupOpen, setIsDatePopupOpen ] = useState( false );

		return (
			<div className="components-dropdown">
				<Button
					isLink={ true }
					onClick={ () => setIsDatePopupOpen( ! isDatePopupOpen ) }
				>
					{ date
						? dateI18n( resolvedDateFormat, date )
						: __( 'Select Date', 'site-functionality' ) }
				</Button>
				{ isDatePopupOpen && (
					<Popover
						position="bottom"
						onClose={ setIsDatePopupOpen.bind( null, false ) }
					>
						<DatePicker
							label={ __( 'Select Date', 'site-functionality' ) }
							currentDate={ date }
							onChange={ setDateTime }
						/>
					</Popover>
				) }
			</div>
		);
	};

	const TimeSelector = () => {
		const [ isTimePopupOpen, setIsTimePopupOpen ] = useState( false );

		return (
			<div className="components-dropdown">
				<Button
					isLink={ true }
					onClick={ () => setIsTimePopupOpen( ! isTimePopupOpen ) }
				>
					{ date
						? dateI18n( resolvedTimeFormat, date )
						: __( 'Select Time', 'site-functionality' ) }
				</Button>
				{ isTimePopupOpen && (
					<Popover
						position="bottom"
						onClose={ setIsTimePopupOpen.bind( null, false ) }
					>
						<TimePicker
							label={ __( 'Select Time', 'site-functionality' ) }
							currentTime={ date }
							onChange={ setDateTime }
							is12Hour={ true }
						/>
					</Popover>
				) }
			</div>
		);
	};

	const DateTimeSelector = () => {
		if ( type === 'time' ) {
			return <TimeSelector />;
		} else {
			return <DateSelector />;
		}
	};

	const FormatSelector = () => {
		let options = dateFormatOptions();
		let resolvedFormat = resolvedDateFormat;
		if ( type === 'time' ) {
			options = timeFormatOptions();
			resolvedFormat = resolvedTimeFormat;
		}

		return (
			<div>
				<CustomSelectControl
					label={ __( 'Format', 'site-functionality' ) }
					options={ options }
					onChange={ setFormat }
					value={ options.find(
						( option ) => option.key === resolvedFormat
					) }
				/>
			</div>
		);
	};

	const SettingsPanel = () => {
		return (
			<InspectorControls>
				<Panel>
					<PanelBody title={ __( 'Format Options' ) } icon="calendar-alt" initialOpen={ true }>
						<PanelRow>
							<FormatSelector />
						</PanelRow>
					</PanelBody>
				</Panel>
			</InspectorControls>
		);
	};

	const blockProps = useBlockProps( {
		className: classNames( className, type ),
	} );

	return (
		<div { ...blockProps }>
			<SettingsPanel />
			<DateTimeSelector />
		</div>
	);
};

export default Edit;
