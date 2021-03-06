"use strict";

var matchTextWithWord = require("../stringProcessing/matchTextWithWord.js");
var escapeRegExp = require("lodash/escapeRegExp");
/**
 * Matches the keyword in the description if a description and keyword are available.
 * default is -1 if no description and/or keyword is specified
 *
 * @param {Paper} paper The paper object containing the description.
 * @returns {number} The number of matches with the keyword
 */
module.exports = function (paper) {
    if (paper.getDescription() === "") {
        return -1;
    }
    var keyword = escapeRegExp(paper.getKeyword());
    return matchTextWithWord(paper.getDescription(), keyword, paper.getLocale());
};
//# sourceMappingURL=metaDescriptionKeyword.js.map
//# sourceMappingURL=metaDescriptionKeyword.js.map
