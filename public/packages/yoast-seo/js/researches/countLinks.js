"use strict";
/** @module analyses/getLinkStatistics */

var getLinks = require("./getLinks");
/**
 * Checks a text for anchors and returns the number found.
 *
 * @param {object} paper The paper object containing text, keyword and url.
 * @returns {number} The number of links found in the text.
 */
module.exports = function (paper) {
  var anchors = getLinks(paper);
  return anchors.length;
};
//# sourceMappingURL=countLinks.js.map
//# sourceMappingURL=countLinks.js.map
