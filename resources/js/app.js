// import './bootstrap';
// import 'laravel-datatables-vite';
// import 'block-ui';
const feather = require('feather-icons')
import * as FilePond from 'filepond';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';
import FilePondPluginFileValidateSize from 'filepond-plugin-file-validate-size';
import FilePondPluginImageValidateSize from 'filepond-plugin-image-validate-size';
import FilePondPluginImageCrop from 'filepond-plugin-image-crop';
import FilePondPluginGetFile from 'filepond-plugin-get-file';
import 'filepond-plugin-get-file/dist/filepond-plugin-get-file.min.css';
import FilePondPluginPdfPreview from 'filepond-plugin-pdf-preview';
import "filepond-plugin-pdf-preview/dist/filepond-plugin-pdf-preview.min.css";
import 'filepond/dist/filepond.min.css';
import lozad from 'lozad';


FilePond.registerPlugin(
    FilePondPluginImagePreview,
    FilePondPluginFileValidateType,
    FilePondPluginFileValidateSize,
    FilePondPluginImageValidateSize,
    FilePondPluginImageCrop,
    FilePondPluginGetFile,
    FilePondPluginPdfPreview
);

export {
    FilePond,
    lozad,
    feather
};
