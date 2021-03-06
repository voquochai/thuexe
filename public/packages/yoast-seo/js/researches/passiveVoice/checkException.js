"use strict";

var isEmpty = require("lodash/isEmpty");
/**
 * Sets sentence part passiveness to passive if no exception rules for the participle apply.
 *
 * @returns {void}
 */
module.exports = function () {
    if (isEmpty(this.getParticiple())) {
        this.setSentencePartPassiveness(false);
        return;
    }
    this.setSentencePartPassiveness(this.isPassive());
};
//# sourceMappingURL=checkException.js.map
//# sourceMappingURL=checkException.js.map
