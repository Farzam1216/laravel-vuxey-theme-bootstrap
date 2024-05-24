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

/***/ "./resources/assets/vendor/libs/filepond/plugins/filepond.filesizevalidation.js":
/*!**************************************************************************************!*\
  !*** ./resources/assets/vendor/libs/filepond/plugins/filepond.filesizevalidation.js ***!
  \**************************************************************************************/
/***/ (function(module, exports, __webpack_require__) {

var __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_RESULT__;function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
/*!
 * FilePondPluginFileValidateSize 2.2.5
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

  var plugin = function plugin(_ref) {
    var addFilter = _ref.addFilter,
      utils = _ref.utils;
    // get quick reference to Type utils
    var Type = utils.Type,
      replaceInString = utils.replaceInString,
      toNaturalFileSize = utils.toNaturalFileSize;

    // filtering if an item is allowed in hopper
    addFilter('ALLOW_HOPPER_ITEM', function (file, _ref2) {
      var query = _ref2.query;
      if (!query('GET_ALLOW_FILE_SIZE_VALIDATION')) {
        return true;
      }
      var sizeMax = query('GET_MAX_FILE_SIZE');
      if (sizeMax !== null && file.size >= sizeMax) {
        return false;
      }
      var sizeMin = query('GET_MIN_FILE_SIZE');
      if (sizeMin !== null && file.size <= sizeMin) {
        return false;
      }
      return true;
    });

    // called for each file that is loaded
    // right before it is set to the item state
    // should return a promise
    addFilter('LOAD_FILE', function (file, _ref3) {
      var query = _ref3.query;
      return new Promise(function (resolve, reject) {
        // if not allowed, all fine, exit
        if (!query('GET_ALLOW_FILE_SIZE_VALIDATION')) {
          return resolve(file);
        }

        // check if file should be filtered
        var fileFilter = query('GET_FILE_VALIDATE_SIZE_FILTER');
        if (fileFilter && !fileFilter(file)) {
          return resolve(file);
        }

        // reject or resolve based on file size
        var sizeMax = query('GET_MAX_FILE_SIZE');
        if (sizeMax !== null && file.size >= sizeMax) {
          reject({
            status: {
              main: query('GET_LABEL_MAX_FILE_SIZE_EXCEEDED'),
              sub: replaceInString(query('GET_LABEL_MAX_FILE_SIZE'), {
                filesize: toNaturalFileSize(sizeMax, '.', query('GET_FILE_SIZE_BASE'), query('GET_FILE_SIZE_LABELS', query))
              })
            }
          });
          return;
        }

        // reject or resolve based on file size
        var sizeMin = query('GET_MIN_FILE_SIZE');
        if (sizeMin !== null && file.size <= sizeMin) {
          reject({
            status: {
              main: query('GET_LABEL_MIN_FILE_SIZE_EXCEEDED'),
              sub: replaceInString(query('GET_LABEL_MIN_FILE_SIZE'), {
                filesize: toNaturalFileSize(sizeMin, '.', query('GET_FILE_SIZE_BASE'), query('GET_FILE_SIZE_LABELS', query))
              })
            }
          });
          return;
        }

        // returns the current option value
        var totalSizeMax = query('GET_MAX_TOTAL_FILE_SIZE');
        if (totalSizeMax !== null) {
          // get the current total file size
          var currentTotalSize = query('GET_ACTIVE_ITEMS').reduce(function (total, item) {
            return total + item.fileSize;
          }, 0);

          // get the size of the new file
          if (currentTotalSize > totalSizeMax) {
            reject({
              status: {
                main: query('GET_LABEL_MAX_TOTAL_FILE_SIZE_EXCEEDED'),
                sub: replaceInString(query('GET_LABEL_MAX_TOTAL_FILE_SIZE'), {
                  filesize: toNaturalFileSize(totalSizeMax, '.', query('GET_FILE_SIZE_BASE'), query('GET_FILE_SIZE_LABELS', query))
                })
              }
            });
            return;
          }
        }

        // file is fine, let's pass it back
        resolve(file);
      });
    });
    return {
      options: {
        // Enable or disable file type validation
        allowFileSizeValidation: [true, Type.BOOLEAN],
        // Max individual file size in bytes
        maxFileSize: [null, Type.INT],
        // Min individual file size in bytes
        minFileSize: [null, Type.INT],
        // Max total file size in bytes
        maxTotalFileSize: [null, Type.INT],
        // Filter the files that need to be validated for size
        fileValidateSizeFilter: [null, Type.FUNCTION],
        // error labels
        labelMinFileSizeExceeded: ['File is too small', Type.STRING],
        labelMinFileSize: ['Minimum file size is {filesize}', Type.STRING],
        labelMaxFileSizeExceeded: ['File is too large', Type.STRING],
        labelMaxFileSize: ['Maximum file size is {filesize}', Type.STRING],
        labelMaxTotalFileSizeExceeded: ['Maximum total size exceeded', Type.STRING],
        labelMaxTotalFileSize: ['Maximum total file size is {filesize}', Type.STRING]
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
/******/ 	var __webpack_exports__ = __webpack_require__("./resources/assets/vendor/libs/filepond/plugins/filepond.filesizevalidation.js");
/******/ 	
/******/ 	return __webpack_exports__;
/******/ })()
;
});