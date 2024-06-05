(function webpackUniversalModuleDefinition(root, factory) {
	if(typeof exports === 'object' && typeof module === 'object')
		module.exports = factory();
	else if(typeof define === 'function' && define.amd)
		define([], factory);
	else {
		var a = factory();
		for(var i in a) (typeof exports === 'object' ? exports : root)[i] = a[i];
	}
})(self, function() {
return /******/ (function() { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/assets/vendor/js/file-pond/filepond-plugin-image-validate-size.js":
/*!*************************************************************************************!*\
  !*** ./resources/assets/vendor/js/file-pond/filepond-plugin-image-validate-size.js ***!
  \*************************************************************************************/
/***/ (function(module, exports, __webpack_require__) {

var __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_RESULT__;function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
/*!
 * FilePondPluginImageValidateSize 1.2.7
 * Licensed under MIT, https://opensource.org/licenses/MIT/
 * Please visit https://pqina.nl/filepond/ for details.
 */

/* eslint-disable */

(function (global, factory) {
  ( false ? 0 : _typeof(exports)) === 'object' && "object" !== 'undefined' ? module.exports = factory() :  true ? !(__WEBPACK_AMD_DEFINE_FACTORY__ = (factory),
		__WEBPACK_AMD_DEFINE_RESULT__ = (typeof __WEBPACK_AMD_DEFINE_FACTORY__ === 'function' ?
		(__WEBPACK_AMD_DEFINE_FACTORY__.call(exports, __webpack_require__, exports, module)) :
		__WEBPACK_AMD_DEFINE_FACTORY__),
		__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__)) : (0);
})(this, function () {
  'use strict';

  // test if file is of type image
  var isImage = function isImage(file) {
    return /^image/.test(file.type);
  };
  var getImageSize = function getImageSize(file) {
    return new Promise(function (resolve, reject) {
      var image = document.createElement('img');
      image.src = URL.createObjectURL(file);
      image.onerror = function (err) {
        clearInterval(intervalId);
        reject(err);
      };
      var intervalId = setInterval(function () {
        if (image.naturalWidth && image.naturalHeight) {
          clearInterval(intervalId);
          URL.revokeObjectURL(image.src);
          resolve({
            width: image.naturalWidth,
            height: image.naturalHeight
          });
        }
      }, 1);
    });
  };
  var plugin = function plugin(_ref) {
    var addFilter = _ref.addFilter,
      utils = _ref.utils;
    // get quick reference to Type utils
    var Type = utils.Type,
      replaceInString = utils.replaceInString,
      isFile = utils.isFile;

    // required file size
    var validateFile = function validateFile(file, bounds, measure) {
      return new Promise(function (resolve, reject) {
        var onReceiveSize = function onReceiveSize(_ref2) {
          var width = _ref2.width,
            height = _ref2.height;
          var minWidth = bounds.minWidth,
            minHeight = bounds.minHeight,
            maxWidth = bounds.maxWidth,
            maxHeight = bounds.maxHeight,
            minResolution = bounds.minResolution,
            maxResolution = bounds.maxResolution;
          var resolution = width * height;

          // validation result
          if (width < minWidth || height < minHeight) {
            reject('TOO_SMALL');
          } else if (width > maxWidth || height > maxHeight) {
            reject('TOO_BIG');
          } else if (minResolution !== null && resolution < minResolution) {
            reject('TOO_LOW_RES');
          } else if (maxResolution !== null && resolution > maxResolution) {
            reject('TOO_HIGH_RES');
          }

          // all is well
          resolve();
        };
        getImageSize(file).then(onReceiveSize)["catch"](function () {
          // no custom measure method supplied, exit here
          if (!measure) {
            reject();
            return;
          }

          // try fallback if defined by user, else reject
          measure(file, bounds).then(onReceiveSize)["catch"](function () {
            return reject();
          });
        });
      });
    };

    // called for each file that is loaded
    // right before it is set to the item state
    // should return a promise
    addFilter('LOAD_FILE', function (file, _ref3) {
      var query = _ref3.query;
      return new Promise(function (resolve, reject) {
        if (!isFile(file) || !isImage(file) || !query('GET_ALLOW_IMAGE_VALIDATE_SIZE')) {
          resolve(file);
          return;
        }

        // get required dimensions
        var bounds = {
          minWidth: query('GET_IMAGE_VALIDATE_SIZE_MIN_WIDTH'),
          minHeight: query('GET_IMAGE_VALIDATE_SIZE_MIN_HEIGHT'),
          maxWidth: query('GET_IMAGE_VALIDATE_SIZE_MAX_WIDTH'),
          maxHeight: query('GET_IMAGE_VALIDATE_SIZE_MAX_HEIGHT'),
          minResolution: query('GET_IMAGE_VALIDATE_SIZE_MIN_RESOLUTION'),
          maxResolution: query('GET_IMAGE_VALIDATE_SIZE_MAX_RESOLUTION')
        };

        // get optional custom measure function
        var measure = query('GET_IMAGE_VALIDATE_SIZE_MEASURE');
        validateFile(file, bounds, measure).then(function () {
          resolve(file);
        })["catch"](function (error) {
          var status = error ? {
            TOO_SMALL: {
              label: query('GET_IMAGE_VALIDATE_SIZE_LABEL_IMAGE_SIZE_TOO_SMALL'),
              details: query('GET_IMAGE_VALIDATE_SIZE_LABEL_EXPECTED_MIN_SIZE')
            },
            TOO_BIG: {
              label: query('GET_IMAGE_VALIDATE_SIZE_LABEL_IMAGE_SIZE_TOO_BIG'),
              details: query('GET_IMAGE_VALIDATE_SIZE_LABEL_EXPECTED_MAX_SIZE')
            },
            TOO_LOW_RES: {
              label: query('GET_IMAGE_VALIDATE_SIZE_LABEL_IMAGE_RESOLUTION_TOO_LOW'),
              details: query('GET_IMAGE_VALIDATE_SIZE_LABEL_EXPECTED_MIN_RESOLUTION')
            },
            TOO_HIGH_RES: {
              label: query('GET_IMAGE_VALIDATE_SIZE_LABEL_IMAGE_RESOLUTION_TOO_HIGH'),
              details: query('GET_IMAGE_VALIDATE_SIZE_LABEL_EXPECTED_MAX_RESOLUTION')
            }
          }[error] : {
            label: query('GET_IMAGE_VALIDATE_SIZE_LABEL_FORMAT_ERROR'),
            details: file.type
          };
          reject({
            status: {
              main: status.label,
              sub: error ? replaceInString(status.details, bounds) : status.details
            }
          });
        });
      });
    });

    // expose plugin
    return {
      // default options
      options: {
        // Enable or disable file type validation
        allowImageValidateSize: [true, Type.BOOLEAN],
        // Error thrown when image can not be loaded
        imageValidateSizeLabelFormatError: ['Image type not supported', Type.STRING],
        // Custom function to use as image measure
        imageValidateSizeMeasure: [null, Type.FUNCTION],
        // Required amount of pixels in the image
        imageValidateSizeMinResolution: [null, Type.INT],
        imageValidateSizeMaxResolution: [null, Type.INT],
        imageValidateSizeLabelImageResolutionTooLow: ['Resolution is too low', Type.STRING],
        imageValidateSizeLabelImageResolutionTooHigh: ['Resolution is too high', Type.STRING],
        imageValidateSizeLabelExpectedMinResolution: ['Minimum resolution is {minResolution}', Type.STRING],
        imageValidateSizeLabelExpectedMaxResolution: ['Maximum resolution is {maxResolution}', Type.STRING],
        // Required dimensions
        imageValidateSizeMinWidth: [1, Type.INT],
        // needs to be at least one pixel
        imageValidateSizeMinHeight: [1, Type.INT],
        imageValidateSizeMaxWidth: [65535, Type.INT],
        // maximum size of JPEG, fine for now I guess
        imageValidateSizeMaxHeight: [65535, Type.INT],
        // Label to show when an image is too small or image is too big
        imageValidateSizeLabelImageSizeTooSmall: ['Image is too small', Type.STRING],
        imageValidateSizeLabelImageSizeTooBig: ['Image is too big', Type.STRING],
        imageValidateSizeLabelExpectedMinSize: ['Minimum size is {minWidth} × {minHeight}', Type.STRING],
        imageValidateSizeLabelExpectedMaxSize: ['Maximum size is {maxWidth} × {maxHeight}', Type.STRING]
      }
    };
  };

  // fire pluginloaded event if running in browser, this allows registering the plugin when using async script tags
  var isBrowser = typeof window !== 'undefined' && typeof window.document !== 'undefined';
  if (isBrowser) {
    document.dispatchEvent(new CustomEvent('FilePond:pluginloaded', {
      detail: plugin
    }));
  }
  return plugin;
});

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module is referenced by other modules so it can't be inlined
/******/ 	var __webpack_exports__ = __webpack_require__("./resources/assets/vendor/js/file-pond/filepond-plugin-image-validate-size.js");
/******/ 	
/******/ 	return __webpack_exports__;
/******/ })()
;
});