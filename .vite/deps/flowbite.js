import {
  createPopper
} from "./chunk-UBNXQJBG.js";
import "./chunk-SSYGV25P.js";

// node_modules/flowbite/lib/esm/dom/events.js
var Events = (
  /** @class */
  function() {
    function Events2(eventType, eventFunctions) {
      if (eventFunctions === void 0) {
        eventFunctions = [];
      }
      this._eventType = eventType;
      this._eventFunctions = eventFunctions;
    }
    Events2.prototype.init = function() {
      var _this = this;
      this._eventFunctions.forEach(function(eventFunction) {
        if (typeof window !== "undefined") {
          window.addEventListener(_this._eventType, eventFunction);
        }
      });
    };
    return Events2;
  }()
);
var events_default = Events;

// node_modules/flowbite/lib/esm/components/accordion/index.js
var __assign = function() {
  __assign = Object.assign || function(t) {
    for (var s, i = 1, n = arguments.length; i < n; i++) {
      s = arguments[i];
      for (var p in s)
        if (Object.prototype.hasOwnProperty.call(s, p))
          t[p] = s[p];
    }
    return t;
  };
  return __assign.apply(this, arguments);
};
var Default = {
  alwaysOpen: false,
  activeClasses: "bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-white",
  inactiveClasses: "text-gray-500 dark:text-gray-400",
  onOpen: function() {
  },
  onClose: function() {
  },
  onToggle: function() {
  }
};
var Accordion = (
  /** @class */
  function() {
    function Accordion2(items, options) {
      if (items === void 0) {
        items = [];
      }
      if (options === void 0) {
        options = Default;
      }
      this._items = items;
      this._options = __assign(__assign({}, Default), options);
      this._init();
    }
    Accordion2.prototype._init = function() {
      var _this = this;
      if (this._items.length) {
        this._items.map(function(item) {
          if (item.active) {
            _this.open(item.id);
          }
          item.triggerEl.addEventListener("click", function() {
            _this.toggle(item.id);
          });
        });
      }
    };
    Accordion2.prototype.getItem = function(id) {
      return this._items.filter(function(item) {
        return item.id === id;
      })[0];
    };
    Accordion2.prototype.open = function(id) {
      var _a, _b;
      var _this = this;
      var item = this.getItem(id);
      if (!this._options.alwaysOpen) {
        this._items.map(function(i) {
          var _a2, _b2;
          if (i !== item) {
            (_a2 = i.triggerEl.classList).remove.apply(_a2, _this._options.activeClasses.split(" "));
            (_b2 = i.triggerEl.classList).add.apply(_b2, _this._options.inactiveClasses.split(" "));
            i.targetEl.classList.add("hidden");
            i.triggerEl.setAttribute("aria-expanded", "false");
            i.active = false;
            if (i.iconEl) {
              i.iconEl.classList.remove("rotate-180");
            }
          }
        });
      }
      (_a = item.triggerEl.classList).add.apply(_a, this._options.activeClasses.split(" "));
      (_b = item.triggerEl.classList).remove.apply(_b, this._options.inactiveClasses.split(" "));
      item.triggerEl.setAttribute("aria-expanded", "true");
      item.targetEl.classList.remove("hidden");
      item.active = true;
      if (item.iconEl) {
        item.iconEl.classList.add("rotate-180");
      }
      this._options.onOpen(this, item);
    };
    Accordion2.prototype.toggle = function(id) {
      var item = this.getItem(id);
      if (item.active) {
        this.close(id);
      } else {
        this.open(id);
      }
      this._options.onToggle(this, item);
    };
    Accordion2.prototype.close = function(id) {
      var _a, _b;
      var item = this.getItem(id);
      (_a = item.triggerEl.classList).remove.apply(_a, this._options.activeClasses.split(" "));
      (_b = item.triggerEl.classList).add.apply(_b, this._options.inactiveClasses.split(" "));
      item.targetEl.classList.add("hidden");
      item.triggerEl.setAttribute("aria-expanded", "false");
      item.active = false;
      if (item.iconEl) {
        item.iconEl.classList.remove("rotate-180");
      }
      this._options.onClose(this, item);
    };
    return Accordion2;
  }()
);
function initAccordions() {
  document.querySelectorAll("[data-accordion]").forEach(function($accordionEl) {
    var alwaysOpen = $accordionEl.getAttribute("data-accordion");
    var activeClasses = $accordionEl.getAttribute("data-active-classes");
    var inactiveClasses = $accordionEl.getAttribute("data-inactive-classes");
    var items = [];
    $accordionEl.querySelectorAll("[data-accordion-target]").forEach(function($triggerEl) {
      if ($triggerEl.closest("[data-accordion]") === $accordionEl) {
        var item = {
          id: $triggerEl.getAttribute("data-accordion-target"),
          triggerEl: $triggerEl,
          targetEl: document.querySelector($triggerEl.getAttribute("data-accordion-target")),
          iconEl: $triggerEl.querySelector("[data-accordion-icon]"),
          active: $triggerEl.getAttribute("aria-expanded") === "true" ? true : false
        };
        items.push(item);
      }
    });
    new Accordion(items, {
      alwaysOpen: alwaysOpen === "open" ? true : false,
      activeClasses: activeClasses ? activeClasses : Default.activeClasses,
      inactiveClasses: inactiveClasses ? inactiveClasses : Default.inactiveClasses
    });
  });
}
if (typeof window !== "undefined") {
  window.Accordion = Accordion;
  window.initAccordions = initAccordions;
}
var accordion_default = Accordion;

// node_modules/flowbite/lib/esm/components/collapse/index.js
var __assign2 = function() {
  __assign2 = Object.assign || function(t) {
    for (var s, i = 1, n = arguments.length; i < n; i++) {
      s = arguments[i];
      for (var p in s)
        if (Object.prototype.hasOwnProperty.call(s, p))
          t[p] = s[p];
    }
    return t;
  };
  return __assign2.apply(this, arguments);
};
var Default2 = {
  onCollapse: function() {
  },
  onExpand: function() {
  },
  onToggle: function() {
  }
};
var Collapse = (
  /** @class */
  function() {
    function Collapse2(targetEl, triggerEl, options) {
      if (targetEl === void 0) {
        targetEl = null;
      }
      if (triggerEl === void 0) {
        triggerEl = null;
      }
      if (options === void 0) {
        options = Default2;
      }
      this._targetEl = targetEl;
      this._triggerEl = triggerEl;
      this._options = __assign2(__assign2({}, Default2), options);
      this._visible = false;
      this._init();
    }
    Collapse2.prototype._init = function() {
      var _this = this;
      if (this._triggerEl) {
        if (this._triggerEl.hasAttribute("aria-expanded")) {
          this._visible = this._triggerEl.getAttribute("aria-expanded") === "true";
        } else {
          this._visible = !this._targetEl.classList.contains("hidden");
        }
        this._triggerEl.addEventListener("click", function() {
          _this.toggle();
        });
      }
    };
    Collapse2.prototype.collapse = function() {
      this._targetEl.classList.add("hidden");
      if (this._triggerEl) {
        this._triggerEl.setAttribute("aria-expanded", "false");
      }
      this._visible = false;
      this._options.onCollapse(this);
    };
    Collapse2.prototype.expand = function() {
      this._targetEl.classList.remove("hidden");
      if (this._triggerEl) {
        this._triggerEl.setAttribute("aria-expanded", "true");
      }
      this._visible = true;
      this._options.onExpand(this);
    };
    Collapse2.prototype.toggle = function() {
      if (this._visible) {
        this.collapse();
      } else {
        this.expand();
      }
      this._options.onToggle(this);
    };
    return Collapse2;
  }()
);
function initCollapses() {
  document.querySelectorAll("[data-collapse-toggle]").forEach(function($triggerEl) {
    var targetId = $triggerEl.getAttribute("data-collapse-toggle");
    var $targetEl = document.getElementById(targetId);
    if ($targetEl) {
      new Collapse($targetEl, $triggerEl);
    } else {
      console.error('The target element with id "'.concat(targetId, '" does not exist. Please check the data-collapse-toggle attribute.'));
    }
  });
}
if (typeof window !== "undefined") {
  window.Collapse = Collapse;
  window.initCollapses = initCollapses;
}
var collapse_default = Collapse;

// node_modules/flowbite/lib/esm/components/carousel/index.js
var __assign3 = function() {
  __assign3 = Object.assign || function(t) {
    for (var s, i = 1, n = arguments.length; i < n; i++) {
      s = arguments[i];
      for (var p in s)
        if (Object.prototype.hasOwnProperty.call(s, p))
          t[p] = s[p];
    }
    return t;
  };
  return __assign3.apply(this, arguments);
};
var Default3 = {
  defaultPosition: 0,
  indicators: {
    items: [],
    activeClasses: "bg-white dark:bg-gray-800",
    inactiveClasses: "bg-white/50 dark:bg-gray-800/50 hover:bg-white dark:hover:bg-gray-800"
  },
  interval: 3e3,
  onNext: function() {
  },
  onPrev: function() {
  },
  onChange: function() {
  }
};
var Carousel = (
  /** @class */
  function() {
    function Carousel2(items, options) {
      if (items === void 0) {
        items = [];
      }
      if (options === void 0) {
        options = Default3;
      }
      this._items = items;
      this._options = __assign3(__assign3(__assign3({}, Default3), options), { indicators: __assign3(__assign3({}, Default3.indicators), options.indicators) });
      this._activeItem = this.getItem(this._options.defaultPosition);
      this._indicators = this._options.indicators.items;
      this._intervalDuration = this._options.interval;
      this._intervalInstance = null;
      this._init();
    }
    Carousel2.prototype._init = function() {
      var _this = this;
      this._items.map(function(item) {
        item.el.classList.add("absolute", "inset-0", "transition-transform", "transform");
      });
      if (this._getActiveItem()) {
        this.slideTo(this._getActiveItem().position);
      } else {
        this.slideTo(0);
      }
      this._indicators.map(function(indicator, position) {
        indicator.el.addEventListener("click", function() {
          _this.slideTo(position);
        });
      });
    };
    Carousel2.prototype.getItem = function(position) {
      return this._items[position];
    };
    Carousel2.prototype.slideTo = function(position) {
      var nextItem = this._items[position];
      var rotationItems = {
        left: nextItem.position === 0 ? this._items[this._items.length - 1] : this._items[nextItem.position - 1],
        middle: nextItem,
        right: nextItem.position === this._items.length - 1 ? this._items[0] : this._items[nextItem.position + 1]
      };
      this._rotate(rotationItems);
      this._setActiveItem(nextItem);
      if (this._intervalInstance) {
        this.pause();
        this.cycle();
      }
      this._options.onChange(this);
    };
    Carousel2.prototype.next = function() {
      var activeItem = this._getActiveItem();
      var nextItem = null;
      if (activeItem.position === this._items.length - 1) {
        nextItem = this._items[0];
      } else {
        nextItem = this._items[activeItem.position + 1];
      }
      this.slideTo(nextItem.position);
      this._options.onNext(this);
    };
    Carousel2.prototype.prev = function() {
      var activeItem = this._getActiveItem();
      var prevItem = null;
      if (activeItem.position === 0) {
        prevItem = this._items[this._items.length - 1];
      } else {
        prevItem = this._items[activeItem.position - 1];
      }
      this.slideTo(prevItem.position);
      this._options.onPrev(this);
    };
    Carousel2.prototype._rotate = function(rotationItems) {
      this._items.map(function(item) {
        item.el.classList.add("hidden");
      });
      rotationItems.left.el.classList.remove("-translate-x-full", "translate-x-full", "translate-x-0", "hidden", "z-20");
      rotationItems.left.el.classList.add("-translate-x-full", "z-10");
      rotationItems.middle.el.classList.remove("-translate-x-full", "translate-x-full", "translate-x-0", "hidden", "z-10");
      rotationItems.middle.el.classList.add("translate-x-0", "z-20");
      rotationItems.right.el.classList.remove("-translate-x-full", "translate-x-full", "translate-x-0", "hidden", "z-20");
      rotationItems.right.el.classList.add("translate-x-full", "z-10");
    };
    Carousel2.prototype.cycle = function() {
      var _this = this;
      if (typeof window !== "undefined") {
        this._intervalInstance = window.setInterval(function() {
          _this.next();
        }, this._intervalDuration);
      }
    };
    Carousel2.prototype.pause = function() {
      clearInterval(this._intervalInstance);
    };
    Carousel2.prototype._getActiveItem = function() {
      return this._activeItem;
    };
    Carousel2.prototype._setActiveItem = function(item) {
      var _a, _b;
      var _this = this;
      this._activeItem = item;
      var position = item.position;
      if (this._indicators.length) {
        this._indicators.map(function(indicator) {
          var _a2, _b2;
          indicator.el.setAttribute("aria-current", "false");
          (_a2 = indicator.el.classList).remove.apply(_a2, _this._options.indicators.activeClasses.split(" "));
          (_b2 = indicator.el.classList).add.apply(_b2, _this._options.indicators.inactiveClasses.split(" "));
        });
        (_a = this._indicators[position].el.classList).add.apply(_a, this._options.indicators.activeClasses.split(" "));
        (_b = this._indicators[position].el.classList).remove.apply(_b, this._options.indicators.inactiveClasses.split(" "));
        this._indicators[position].el.setAttribute("aria-current", "true");
      }
    };
    return Carousel2;
  }()
);
function initCarousels() {
  document.querySelectorAll("[data-carousel]").forEach(function($carouselEl) {
    var interval = $carouselEl.getAttribute("data-carousel-interval");
    var slide = $carouselEl.getAttribute("data-carousel") === "slide" ? true : false;
    var items = [];
    var defaultPosition = 0;
    if ($carouselEl.querySelectorAll("[data-carousel-item]").length) {
      Array.from($carouselEl.querySelectorAll("[data-carousel-item]")).map(function($carouselItemEl, position) {
        items.push({
          position,
          el: $carouselItemEl
        });
        if ($carouselItemEl.getAttribute("data-carousel-item") === "active") {
          defaultPosition = position;
        }
      });
    }
    var indicators = [];
    if ($carouselEl.querySelectorAll("[data-carousel-slide-to]").length) {
      Array.from($carouselEl.querySelectorAll("[data-carousel-slide-to]")).map(function($indicatorEl) {
        indicators.push({
          position: parseInt($indicatorEl.getAttribute("data-carousel-slide-to")),
          el: $indicatorEl
        });
      });
    }
    var carousel = new Carousel(items, {
      defaultPosition,
      indicators: {
        items: indicators
      },
      interval: interval ? interval : Default3.interval
    });
    if (slide) {
      carousel.cycle();
    }
    var carouselNextEl = $carouselEl.querySelector("[data-carousel-next]");
    var carouselPrevEl = $carouselEl.querySelector("[data-carousel-prev]");
    if (carouselNextEl) {
      carouselNextEl.addEventListener("click", function() {
        carousel.next();
      });
    }
    if (carouselPrevEl) {
      carouselPrevEl.addEventListener("click", function() {
        carousel.prev();
      });
    }
  });
}
if (typeof window !== "undefined") {
  window.Carousel = Carousel;
  window.initCarousels = initCarousels;
}
var carousel_default = Carousel;

// node_modules/flowbite/lib/esm/components/dismiss/index.js
var __assign4 = function() {
  __assign4 = Object.assign || function(t) {
    for (var s, i = 1, n = arguments.length; i < n; i++) {
      s = arguments[i];
      for (var p in s)
        if (Object.prototype.hasOwnProperty.call(s, p))
          t[p] = s[p];
    }
    return t;
  };
  return __assign4.apply(this, arguments);
};
var Default4 = {
  transition: "transition-opacity",
  duration: 300,
  timing: "ease-out",
  onHide: function() {
  }
};
var Dismiss = (
  /** @class */
  function() {
    function Dismiss2(targetEl, triggerEl, options) {
      if (targetEl === void 0) {
        targetEl = null;
      }
      if (triggerEl === void 0) {
        triggerEl = null;
      }
      if (options === void 0) {
        options = Default4;
      }
      this._targetEl = targetEl;
      this._triggerEl = triggerEl;
      this._options = __assign4(__assign4({}, Default4), options);
      this._init();
    }
    Dismiss2.prototype._init = function() {
      var _this = this;
      if (this._triggerEl) {
        this._triggerEl.addEventListener("click", function() {
          _this.hide();
        });
      }
    };
    Dismiss2.prototype.hide = function() {
      var _this = this;
      this._targetEl.classList.add(this._options.transition, "duration-".concat(this._options.duration), this._options.timing, "opacity-0");
      setTimeout(function() {
        _this._targetEl.classList.add("hidden");
      }, this._options.duration);
      this._options.onHide(this, this._targetEl);
    };
    return Dismiss2;
  }()
);
function initDismisses() {
  document.querySelectorAll("[data-dismiss-target]").forEach(function($triggerEl) {
    var targetId = $triggerEl.getAttribute("data-dismiss-target");
    var $dismissEl = document.querySelector(targetId);
    if ($dismissEl) {
      new Dismiss($dismissEl, $triggerEl);
    } else {
      console.error('The dismiss element with id "'.concat(targetId, '" does not exist. Please check the data-dismiss-target attribute.'));
    }
  });
}
if (typeof window !== "undefined") {
  window.Dismiss = Dismiss;
  window.initDismisses = initDismisses;
}
var dismiss_default = Dismiss;

// node_modules/flowbite/lib/esm/components/dropdown/index.js
var __assign5 = function() {
  __assign5 = Object.assign || function(t) {
    for (var s, i = 1, n = arguments.length; i < n; i++) {
      s = arguments[i];
      for (var p in s)
        if (Object.prototype.hasOwnProperty.call(s, p))
          t[p] = s[p];
    }
    return t;
  };
  return __assign5.apply(this, arguments);
};
var __spreadArray = function(to, from, pack) {
  if (pack || arguments.length === 2)
    for (var i = 0, l = from.length, ar; i < l; i++) {
      if (ar || !(i in from)) {
        if (!ar)
          ar = Array.prototype.slice.call(from, 0, i);
        ar[i] = from[i];
      }
    }
  return to.concat(ar || Array.prototype.slice.call(from));
};
var Default5 = {
  placement: "bottom",
  triggerType: "click",
  offsetSkidding: 0,
  offsetDistance: 10,
  delay: 300,
  ignoreClickOutsideClass: false,
  onShow: function() {
  },
  onHide: function() {
  },
  onToggle: function() {
  }
};
var Dropdown = (
  /** @class */
  function() {
    function Dropdown2(targetElement, triggerElement, options) {
      if (targetElement === void 0) {
        targetElement = null;
      }
      if (triggerElement === void 0) {
        triggerElement = null;
      }
      if (options === void 0) {
        options = Default5;
      }
      this._targetEl = targetElement;
      this._triggerEl = triggerElement;
      this._options = __assign5(__assign5({}, Default5), options);
      this._popperInstance = this._createPopperInstance();
      this._visible = false;
      this._init();
    }
    Dropdown2.prototype._init = function() {
      if (this._triggerEl) {
        this._setupEventListeners();
      }
    };
    Dropdown2.prototype._setupEventListeners = function() {
      var _this = this;
      var triggerEvents = this._getTriggerEvents();
      if (this._options.triggerType === "click") {
        triggerEvents.showEvents.forEach(function(ev) {
          _this._triggerEl.addEventListener(ev, function() {
            _this.toggle();
          });
        });
      }
      if (this._options.triggerType === "hover") {
        triggerEvents.showEvents.forEach(function(ev) {
          _this._triggerEl.addEventListener(ev, function() {
            if (ev === "click") {
              _this.toggle();
            } else {
              setTimeout(function() {
                _this.show();
              }, _this._options.delay);
            }
          });
          _this._targetEl.addEventListener(ev, function() {
            _this.show();
          });
        });
        triggerEvents.hideEvents.forEach(function(ev) {
          _this._triggerEl.addEventListener(ev, function() {
            setTimeout(function() {
              if (!_this._targetEl.matches(":hover")) {
                _this.hide();
              }
            }, _this._options.delay);
          });
          _this._targetEl.addEventListener(ev, function() {
            setTimeout(function() {
              if (!_this._triggerEl.matches(":hover")) {
                _this.hide();
              }
            }, _this._options.delay);
          });
        });
      }
    };
    Dropdown2.prototype._createPopperInstance = function() {
      return createPopper(this._triggerEl, this._targetEl, {
        placement: this._options.placement,
        modifiers: [
          {
            name: "offset",
            options: {
              offset: [
                this._options.offsetSkidding,
                this._options.offsetDistance
              ]
            }
          }
        ]
      });
    };
    Dropdown2.prototype._setupClickOutsideListener = function() {
      var _this = this;
      this._clickOutsideEventListener = function(ev) {
        _this._handleClickOutside(ev, _this._targetEl);
      };
      document.body.addEventListener("click", this._clickOutsideEventListener, true);
    };
    Dropdown2.prototype._removeClickOutsideListener = function() {
      document.body.removeEventListener("click", this._clickOutsideEventListener, true);
    };
    Dropdown2.prototype._handleClickOutside = function(ev, targetEl) {
      var clickedEl = ev.target;
      var ignoreClickOutsideClass = this._options.ignoreClickOutsideClass;
      var isIgnored = false;
      if (ignoreClickOutsideClass) {
        var ignoredClickOutsideEls = document.querySelectorAll(".".concat(ignoreClickOutsideClass));
        ignoredClickOutsideEls.forEach(function(el) {
          if (el.contains(clickedEl)) {
            isIgnored = true;
            return;
          }
        });
      }
      if (clickedEl !== targetEl && !targetEl.contains(clickedEl) && !this._triggerEl.contains(clickedEl) && !isIgnored && this.isVisible()) {
        this.hide();
      }
    };
    Dropdown2.prototype._getTriggerEvents = function() {
      switch (this._options.triggerType) {
        case "hover":
          return {
            showEvents: ["mouseenter", "click"],
            hideEvents: ["mouseleave"]
          };
        case "click":
          return {
            showEvents: ["click"],
            hideEvents: []
          };
        case "none":
          return {
            showEvents: [],
            hideEvents: []
          };
        default:
          return {
            showEvents: ["click"],
            hideEvents: []
          };
      }
    };
    Dropdown2.prototype.toggle = function() {
      if (this.isVisible()) {
        this.hide();
      } else {
        this.show();
      }
      this._options.onToggle(this);
    };
    Dropdown2.prototype.isVisible = function() {
      return this._visible;
    };
    Dropdown2.prototype.show = function() {
      this._targetEl.classList.remove("hidden");
      this._targetEl.classList.add("block");
      this._popperInstance.setOptions(function(options) {
        return __assign5(__assign5({}, options), { modifiers: __spreadArray(__spreadArray([], options.modifiers, true), [
          { name: "eventListeners", enabled: true }
        ], false) });
      });
      this._setupClickOutsideListener();
      this._popperInstance.update();
      this._visible = true;
      this._options.onShow(this);
    };
    Dropdown2.prototype.hide = function() {
      this._targetEl.classList.remove("block");
      this._targetEl.classList.add("hidden");
      this._popperInstance.setOptions(function(options) {
        return __assign5(__assign5({}, options), { modifiers: __spreadArray(__spreadArray([], options.modifiers, true), [
          { name: "eventListeners", enabled: false }
        ], false) });
      });
      this._visible = false;
      this._removeClickOutsideListener();
      this._options.onHide(this);
    };
    return Dropdown2;
  }()
);
function initDropdowns() {
  document.querySelectorAll("[data-dropdown-toggle]").forEach(function($triggerEl) {
    var dropdownId = $triggerEl.getAttribute("data-dropdown-toggle");
    var $dropdownEl = document.getElementById(dropdownId);
    if ($dropdownEl) {
      var placement = $triggerEl.getAttribute("data-dropdown-placement");
      var offsetSkidding = $triggerEl.getAttribute("data-dropdown-offset-skidding");
      var offsetDistance = $triggerEl.getAttribute("data-dropdown-offset-distance");
      var triggerType = $triggerEl.getAttribute("data-dropdown-trigger");
      var delay = $triggerEl.getAttribute("data-dropdown-delay");
      var ignoreClickOutsideClass = $triggerEl.getAttribute("data-dropdown-ignore-click-outside-class");
      new Dropdown($dropdownEl, $triggerEl, {
        placement: placement ? placement : Default5.placement,
        triggerType: triggerType ? triggerType : Default5.triggerType,
        offsetSkidding: offsetSkidding ? parseInt(offsetSkidding) : Default5.offsetSkidding,
        offsetDistance: offsetDistance ? parseInt(offsetDistance) : Default5.offsetDistance,
        delay: delay ? parseInt(delay) : Default5.delay,
        ignoreClickOutsideClass: ignoreClickOutsideClass ? ignoreClickOutsideClass : Default5.ignoreClickOutsideClass
      });
    } else {
      console.error('The dropdown element with id "'.concat(dropdownId, '" does not exist. Please check the data-dropdown-toggle attribute.'));
    }
  });
}
if (typeof window !== "undefined") {
  window.Dropdown = Dropdown;
  window.initDropdowns = initDropdowns;
}
var dropdown_default = Dropdown;

// node_modules/flowbite/lib/esm/components/modal/index.js
var __assign6 = function() {
  __assign6 = Object.assign || function(t) {
    for (var s, i = 1, n = arguments.length; i < n; i++) {
      s = arguments[i];
      for (var p in s)
        if (Object.prototype.hasOwnProperty.call(s, p))
          t[p] = s[p];
    }
    return t;
  };
  return __assign6.apply(this, arguments);
};
var Default6 = {
  placement: "center",
  backdropClasses: "bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-40",
  backdrop: "dynamic",
  closable: true,
  onHide: function() {
  },
  onShow: function() {
  },
  onToggle: function() {
  }
};
var Modal = (
  /** @class */
  function() {
    function Modal2(targetEl, options) {
      if (targetEl === void 0) {
        targetEl = null;
      }
      if (options === void 0) {
        options = Default6;
      }
      this._targetEl = targetEl;
      this._options = __assign6(__assign6({}, Default6), options);
      this._isHidden = true;
      this._backdropEl = null;
      this._init();
    }
    Modal2.prototype._init = function() {
      var _this = this;
      if (this._targetEl) {
        this._getPlacementClasses().map(function(c) {
          _this._targetEl.classList.add(c);
        });
      }
    };
    Modal2.prototype._createBackdrop = function() {
      var _a;
      if (this._isHidden) {
        var backdropEl = document.createElement("div");
        backdropEl.setAttribute("modal-backdrop", "");
        (_a = backdropEl.classList).add.apply(_a, this._options.backdropClasses.split(" "));
        document.querySelector("body").append(backdropEl);
        this._backdropEl = backdropEl;
      }
    };
    Modal2.prototype._destroyBackdropEl = function() {
      if (!this._isHidden) {
        document.querySelector("[modal-backdrop]").remove();
      }
    };
    Modal2.prototype._setupModalCloseEventListeners = function() {
      var _this = this;
      if (this._options.backdrop === "dynamic") {
        this._clickOutsideEventListener = function(ev) {
          _this._handleOutsideClick(ev.target);
        };
        this._targetEl.addEventListener("click", this._clickOutsideEventListener, true);
      }
      this._keydownEventListener = function(ev) {
        if (ev.key === "Escape") {
          _this.hide();
        }
      };
      document.body.addEventListener("keydown", this._keydownEventListener, true);
    };
    Modal2.prototype._removeModalCloseEventListeners = function() {
      if (this._options.backdrop === "dynamic") {
        this._targetEl.removeEventListener("click", this._clickOutsideEventListener, true);
      }
      document.body.removeEventListener("keydown", this._keydownEventListener, true);
    };
    Modal2.prototype._handleOutsideClick = function(target) {
      if (target === this._targetEl || target === this._backdropEl && this.isVisible()) {
        this.hide();
      }
    };
    Modal2.prototype._getPlacementClasses = function() {
      switch (this._options.placement) {
        case "top-left":
          return ["justify-start", "items-start"];
        case "top-center":
          return ["justify-center", "items-start"];
        case "top-right":
          return ["justify-end", "items-start"];
        case "center-left":
          return ["justify-start", "items-center"];
        case "center":
          return ["justify-center", "items-center"];
        case "center-right":
          return ["justify-end", "items-center"];
        case "bottom-left":
          return ["justify-start", "items-end"];
        case "bottom-center":
          return ["justify-center", "items-end"];
        case "bottom-right":
          return ["justify-end", "items-end"];
        default:
          return ["justify-center", "items-center"];
      }
    };
    Modal2.prototype.toggle = function() {
      if (this._isHidden) {
        this.show();
      } else {
        this.hide();
      }
      this._options.onToggle(this);
    };
    Modal2.prototype.show = function() {
      if (this.isHidden) {
        this._targetEl.classList.add("flex");
        this._targetEl.classList.remove("hidden");
        this._targetEl.setAttribute("aria-modal", "true");
        this._targetEl.setAttribute("role", "dialog");
        this._targetEl.removeAttribute("aria-hidden");
        this._createBackdrop();
        this._isHidden = false;
        document.body.classList.add("overflow-hidden");
        if (this._options.closable) {
          this._setupModalCloseEventListeners();
        }
        this._options.onShow(this);
      }
    };
    Modal2.prototype.hide = function() {
      if (this.isVisible) {
        this._targetEl.classList.add("hidden");
        this._targetEl.classList.remove("flex");
        this._targetEl.setAttribute("aria-hidden", "true");
        this._targetEl.removeAttribute("aria-modal");
        this._targetEl.removeAttribute("role");
        this._destroyBackdropEl();
        this._isHidden = true;
        document.body.classList.remove("overflow-hidden");
        if (this._options.closable) {
          this._removeModalCloseEventListeners();
        }
        this._options.onHide(this);
      }
    };
    Modal2.prototype.isVisible = function() {
      return !this._isHidden;
    };
    Modal2.prototype.isHidden = function() {
      return this._isHidden;
    };
    return Modal2;
  }()
);
var getModalInstance = function(id, instances) {
  if (instances.some(function(modalInstance) {
    return modalInstance.id === id;
  })) {
    return instances.find(function(modalInstance) {
      return modalInstance.id === id;
    });
  }
  return null;
};
function initModals() {
  var modalInstances = [];
  document.querySelectorAll("[data-modal-target]").forEach(function($triggerEl) {
    var modalId = $triggerEl.getAttribute("data-modal-target");
    var $modalEl = document.getElementById(modalId);
    if ($modalEl) {
      var placement = $modalEl.getAttribute("data-modal-placement");
      var backdrop = $modalEl.getAttribute("data-modal-backdrop");
      if (!getModalInstance(modalId, modalInstances)) {
        modalInstances.push({
          id: modalId,
          object: new Modal($modalEl, {
            placement: placement ? placement : Default6.placement,
            backdrop: backdrop ? backdrop : Default6.backdrop
          })
        });
      }
    } else {
      console.error("Modal with id ".concat(modalId, " does not exist. Are you sure that the data-modal-target attribute points to the correct modal id?."));
    }
  });
  document.querySelectorAll("[data-modal-toggle]").forEach(function($triggerEl) {
    var modalId = $triggerEl.getAttribute("data-modal-toggle");
    var $modalEl = document.getElementById(modalId);
    if ($modalEl) {
      var placement = $modalEl.getAttribute("data-modal-placement");
      var backdrop = $modalEl.getAttribute("data-modal-backdrop");
      var modal_1 = getModalInstance(modalId, modalInstances);
      if (!modal_1) {
        modal_1 = {
          id: modalId,
          object: new Modal($modalEl, {
            placement: placement ? placement : Default6.placement,
            backdrop: backdrop ? backdrop : Default6.backdrop
          })
        };
        modalInstances.push(modal_1);
      }
      $triggerEl.addEventListener("click", function() {
        modal_1.object.toggle();
      });
    } else {
      console.error("Modal with id ".concat(modalId, " does not exist. Are you sure that the data-modal-toggle attribute points to the correct modal id?"));
    }
  });
  document.querySelectorAll("[data-modal-show]").forEach(function($triggerEl) {
    var modalId = $triggerEl.getAttribute("data-modal-show");
    var $modalEl = document.getElementById(modalId);
    if ($modalEl) {
      var modal_2 = getModalInstance(modalId, modalInstances);
      if (modal_2) {
        $triggerEl.addEventListener("click", function() {
          if (modal_2.object.isHidden) {
            modal_2.object.show();
          }
        });
      } else {
        console.error("Modal with id ".concat(modalId, " has not been initialized. Please initialize it using the data-modal-target attribute."));
      }
    } else {
      console.error("Modal with id ".concat(modalId, " does not exist. Are you sure that the data-modal-show attribute points to the correct modal id?"));
    }
  });
  document.querySelectorAll("[data-modal-hide]").forEach(function($triggerEl) {
    var modalId = $triggerEl.getAttribute("data-modal-hide");
    var $modalEl = document.getElementById(modalId);
    if ($modalEl) {
      var modal_3 = getModalInstance(modalId, modalInstances);
      if (modal_3) {
        $triggerEl.addEventListener("click", function() {
          if (modal_3.object.isVisible) {
            modal_3.object.hide();
          }
        });
      } else {
        console.error("Modal with id ".concat(modalId, " has not been initialized. Please initialize it using the data-modal-target attribute."));
      }
    } else {
      console.error("Modal with id ".concat(modalId, " does not exist. Are you sure that the data-modal-hide attribute points to the correct modal id?"));
    }
  });
}
if (typeof window !== "undefined") {
  window.Modal = Modal;
  window.initModals = initModals;
}
var modal_default = Modal;

// node_modules/flowbite/lib/esm/components/drawer/index.js
var __assign7 = function() {
  __assign7 = Object.assign || function(t) {
    for (var s, i = 1, n = arguments.length; i < n; i++) {
      s = arguments[i];
      for (var p in s)
        if (Object.prototype.hasOwnProperty.call(s, p))
          t[p] = s[p];
    }
    return t;
  };
  return __assign7.apply(this, arguments);
};
var Default7 = {
  placement: "left",
  bodyScrolling: false,
  backdrop: true,
  edge: false,
  edgeOffset: "bottom-[60px]",
  backdropClasses: "bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-30",
  onShow: function() {
  },
  onHide: function() {
  },
  onToggle: function() {
  }
};
var Drawer = (
  /** @class */
  function() {
    function Drawer2(targetEl, options) {
      if (targetEl === void 0) {
        targetEl = null;
      }
      if (options === void 0) {
        options = Default7;
      }
      this._targetEl = targetEl;
      this._options = __assign7(__assign7({}, Default7), options);
      this._visible = false;
      this._init();
    }
    Drawer2.prototype._init = function() {
      var _this = this;
      if (this._targetEl) {
        this._targetEl.setAttribute("aria-hidden", "true");
        this._targetEl.classList.add("transition-transform");
      }
      this._getPlacementClasses(this._options.placement).base.map(function(c) {
        _this._targetEl.classList.add(c);
      });
      document.addEventListener("keydown", function(event) {
        if (event.key === "Escape") {
          if (_this.isVisible()) {
            _this.hide();
          }
        }
      });
    };
    Drawer2.prototype.hide = function() {
      var _this = this;
      if (this._options.edge) {
        this._getPlacementClasses(this._options.placement + "-edge").active.map(function(c) {
          _this._targetEl.classList.remove(c);
        });
        this._getPlacementClasses(this._options.placement + "-edge").inactive.map(function(c) {
          _this._targetEl.classList.add(c);
        });
      } else {
        this._getPlacementClasses(this._options.placement).active.map(function(c) {
          _this._targetEl.classList.remove(c);
        });
        this._getPlacementClasses(this._options.placement).inactive.map(function(c) {
          _this._targetEl.classList.add(c);
        });
      }
      this._targetEl.setAttribute("aria-hidden", "true");
      this._targetEl.removeAttribute("aria-modal");
      this._targetEl.removeAttribute("role");
      if (!this._options.bodyScrolling) {
        document.body.classList.remove("overflow-hidden");
      }
      if (this._options.backdrop) {
        this._destroyBackdropEl();
      }
      this._visible = false;
      this._options.onHide(this);
    };
    Drawer2.prototype.show = function() {
      var _this = this;
      if (this._options.edge) {
        this._getPlacementClasses(this._options.placement + "-edge").active.map(function(c) {
          _this._targetEl.classList.add(c);
        });
        this._getPlacementClasses(this._options.placement + "-edge").inactive.map(function(c) {
          _this._targetEl.classList.remove(c);
        });
      } else {
        this._getPlacementClasses(this._options.placement).active.map(function(c) {
          _this._targetEl.classList.add(c);
        });
        this._getPlacementClasses(this._options.placement).inactive.map(function(c) {
          _this._targetEl.classList.remove(c);
        });
      }
      this._targetEl.setAttribute("aria-modal", "true");
      this._targetEl.setAttribute("role", "dialog");
      this._targetEl.removeAttribute("aria-hidden");
      if (!this._options.bodyScrolling) {
        document.body.classList.add("overflow-hidden");
      }
      if (this._options.backdrop) {
        this._createBackdrop();
      }
      this._visible = true;
      this._options.onShow(this);
    };
    Drawer2.prototype.toggle = function() {
      if (this.isVisible()) {
        this.hide();
      } else {
        this.show();
      }
    };
    Drawer2.prototype._createBackdrop = function() {
      var _a;
      var _this = this;
      if (!this._visible) {
        var backdropEl = document.createElement("div");
        backdropEl.setAttribute("drawer-backdrop", "");
        (_a = backdropEl.classList).add.apply(_a, this._options.backdropClasses.split(" "));
        document.querySelector("body").append(backdropEl);
        backdropEl.addEventListener("click", function() {
          _this.hide();
        });
      }
    };
    Drawer2.prototype._destroyBackdropEl = function() {
      if (this._visible) {
        document.querySelector("[drawer-backdrop]").remove();
      }
    };
    Drawer2.prototype._getPlacementClasses = function(placement) {
      switch (placement) {
        case "top":
          return {
            base: ["top-0", "left-0", "right-0"],
            active: ["transform-none"],
            inactive: ["-translate-y-full"]
          };
        case "right":
          return {
            base: ["right-0", "top-0"],
            active: ["transform-none"],
            inactive: ["translate-x-full"]
          };
        case "bottom":
          return {
            base: ["bottom-0", "left-0", "right-0"],
            active: ["transform-none"],
            inactive: ["translate-y-full"]
          };
        case "left":
          return {
            base: ["left-0", "top-0"],
            active: ["transform-none"],
            inactive: ["-translate-x-full"]
          };
        case "bottom-edge":
          return {
            base: ["left-0", "top-0"],
            active: ["transform-none"],
            inactive: ["translate-y-full", this._options.edgeOffset]
          };
        default:
          return {
            base: ["left-0", "top-0"],
            active: ["transform-none"],
            inactive: ["-translate-x-full"]
          };
      }
    };
    Drawer2.prototype.isHidden = function() {
      return !this._visible;
    };
    Drawer2.prototype.isVisible = function() {
      return this._visible;
    };
    return Drawer2;
  }()
);
var getDrawerInstance = function(id, instances) {
  if (instances.some(function(drawerInstance) {
    return drawerInstance.id === id;
  })) {
    return instances.find(function(drawerInstance) {
      return drawerInstance.id === id;
    });
  }
};
function initDrawers() {
  var drawerInstances = [];
  document.querySelectorAll("[data-drawer-target]").forEach(function($triggerEl) {
    var drawerId = $triggerEl.getAttribute("data-drawer-target");
    var $drawerEl = document.getElementById(drawerId);
    if ($drawerEl) {
      var placement = $triggerEl.getAttribute("data-drawer-placement");
      var bodyScrolling = $triggerEl.getAttribute("data-drawer-body-scrolling");
      var backdrop = $triggerEl.getAttribute("data-drawer-backdrop");
      var edge = $triggerEl.getAttribute("data-drawer-edge");
      var edgeOffset = $triggerEl.getAttribute("data-drawer-edge-offset");
      if (!getDrawerInstance(drawerId, drawerInstances)) {
        drawerInstances.push({
          id: drawerId,
          object: new Drawer($drawerEl, {
            placement: placement ? placement : Default7.placement,
            bodyScrolling: bodyScrolling ? bodyScrolling === "true" ? true : false : Default7.bodyScrolling,
            backdrop: backdrop ? backdrop === "true" ? true : false : Default7.backdrop,
            edge: edge ? edge === "true" ? true : false : Default7.edge,
            edgeOffset: edgeOffset ? edgeOffset : Default7.edgeOffset
          })
        });
      }
    } else {
      console.error("Drawer with id ".concat(drawerId, " not found. Are you sure that the data-drawer-target attribute points to the correct drawer id?"));
    }
  });
  document.querySelectorAll("[data-drawer-toggle]").forEach(function($triggerEl) {
    var drawerId = $triggerEl.getAttribute("data-drawer-toggle");
    var $drawerEl = document.getElementById(drawerId);
    if ($drawerEl) {
      var drawer_1 = getDrawerInstance(drawerId, drawerInstances);
      if (drawer_1) {
        $triggerEl.addEventListener("click", function() {
          drawer_1.object.toggle();
        });
      } else {
        console.error("Drawer with id ".concat(drawerId, " has not been initialized. Please initialize it using the data-drawer-target attribute."));
      }
    } else {
      console.error("Drawer with id ".concat(drawerId, " not found. Are you sure that the data-drawer-target attribute points to the correct drawer id?"));
    }
  });
  document.querySelectorAll("[data-drawer-dismiss], [data-drawer-hide]").forEach(function($triggerEl) {
    var drawerId = $triggerEl.getAttribute("data-drawer-dismiss") ? $triggerEl.getAttribute("data-drawer-dismiss") : $triggerEl.getAttribute("data-drawer-hide");
    var $drawerEl = document.getElementById(drawerId);
    if ($drawerEl) {
      var drawer_2 = getDrawerInstance(drawerId, drawerInstances);
      if (drawer_2) {
        $triggerEl.addEventListener("click", function() {
          drawer_2.object.hide();
        });
      } else {
        console.error("Drawer with id ".concat(drawerId, " has not been initialized. Please initialize it using the data-drawer-target attribute."));
      }
    } else {
      console.error("Drawer with id ".concat(drawerId, " not found. Are you sure that the data-drawer-target attribute points to the correct drawer id"));
    }
  });
  document.querySelectorAll("[data-drawer-show]").forEach(function($triggerEl) {
    var drawerId = $triggerEl.getAttribute("data-drawer-show");
    var $drawerEl = document.getElementById(drawerId);
    if ($drawerEl) {
      var drawer_3 = getDrawerInstance(drawerId, drawerInstances);
      if (drawer_3) {
        $triggerEl.addEventListener("click", function() {
          drawer_3.object.show();
        });
      } else {
        console.error("Drawer with id ".concat(drawerId, " has not been initialized. Please initialize it using the data-drawer-target attribute."));
      }
    } else {
      console.error("Drawer with id ".concat(drawerId, " not found. Are you sure that the data-drawer-target attribute points to the correct drawer id?"));
    }
  });
}
if (typeof window !== "undefined") {
  window.Drawer = Drawer;
  window.initDrawers = initDrawers;
}
var drawer_default = Drawer;

// node_modules/flowbite/lib/esm/components/tabs/index.js
var __assign8 = function() {
  __assign8 = Object.assign || function(t) {
    for (var s, i = 1, n = arguments.length; i < n; i++) {
      s = arguments[i];
      for (var p in s)
        if (Object.prototype.hasOwnProperty.call(s, p))
          t[p] = s[p];
    }
    return t;
  };
  return __assign8.apply(this, arguments);
};
var Default8 = {
  defaultTabId: null,
  activeClasses: "text-blue-600 hover:text-blue-600 dark:text-blue-500 dark:hover:text-blue-500 border-blue-600 dark:border-blue-500",
  inactiveClasses: "dark:border-transparent text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300",
  onShow: function() {
  }
};
var Tabs = (
  /** @class */
  function() {
    function Tabs2(items, options) {
      if (items === void 0) {
        items = [];
      }
      if (options === void 0) {
        options = Default8;
      }
      this._items = items;
      this._activeTab = options ? this.getTab(options.defaultTabId) : null;
      this._options = __assign8(__assign8({}, Default8), options);
      this._init();
    }
    Tabs2.prototype._init = function() {
      var _this = this;
      if (this._items.length) {
        if (!this._activeTab) {
          this._setActiveTab(this._items[0]);
        }
        this.show(this._activeTab.id, true);
        this._items.map(function(tab) {
          tab.triggerEl.addEventListener("click", function() {
            _this.show(tab.id);
          });
        });
      }
    };
    Tabs2.prototype.getActiveTab = function() {
      return this._activeTab;
    };
    Tabs2.prototype._setActiveTab = function(tab) {
      this._activeTab = tab;
    };
    Tabs2.prototype.getTab = function(id) {
      return this._items.filter(function(t) {
        return t.id === id;
      })[0];
    };
    Tabs2.prototype.show = function(id, forceShow) {
      var _a, _b;
      var _this = this;
      if (forceShow === void 0) {
        forceShow = false;
      }
      var tab = this.getTab(id);
      if (tab === this._activeTab && !forceShow) {
        return;
      }
      this._items.map(function(t) {
        var _a2, _b2;
        if (t !== tab) {
          (_a2 = t.triggerEl.classList).remove.apply(_a2, _this._options.activeClasses.split(" "));
          (_b2 = t.triggerEl.classList).add.apply(_b2, _this._options.inactiveClasses.split(" "));
          t.targetEl.classList.add("hidden");
          t.triggerEl.setAttribute("aria-selected", "false");
        }
      });
      (_a = tab.triggerEl.classList).add.apply(_a, this._options.activeClasses.split(" "));
      (_b = tab.triggerEl.classList).remove.apply(_b, this._options.inactiveClasses.split(" "));
      tab.triggerEl.setAttribute("aria-selected", "true");
      tab.targetEl.classList.remove("hidden");
      this._setActiveTab(tab);
      this._options.onShow(this, tab);
    };
    return Tabs2;
  }()
);
function initTabs() {
  document.querySelectorAll("[data-tabs-toggle]").forEach(function($triggerEl) {
    var tabItems = [];
    var defaultTabId = null;
    $triggerEl.querySelectorAll('[role="tab"]').forEach(function($triggerEl2) {
      var isActive = $triggerEl2.getAttribute("aria-selected") === "true";
      var tab = {
        id: $triggerEl2.getAttribute("data-tabs-target"),
        triggerEl: $triggerEl2,
        targetEl: document.querySelector($triggerEl2.getAttribute("data-tabs-target"))
      };
      tabItems.push(tab);
      if (isActive) {
        defaultTabId = tab.id;
      }
    });
    new Tabs(tabItems, {
      defaultTabId
    });
  });
}
if (typeof window !== "undefined") {
  window.Tabs = Tabs;
  window.initTabs = initTabs;
}
var tabs_default = Tabs;

// node_modules/flowbite/lib/esm/components/tooltip/index.js
var __assign9 = function() {
  __assign9 = Object.assign || function(t) {
    for (var s, i = 1, n = arguments.length; i < n; i++) {
      s = arguments[i];
      for (var p in s)
        if (Object.prototype.hasOwnProperty.call(s, p))
          t[p] = s[p];
    }
    return t;
  };
  return __assign9.apply(this, arguments);
};
var __spreadArray2 = function(to, from, pack) {
  if (pack || arguments.length === 2)
    for (var i = 0, l = from.length, ar; i < l; i++) {
      if (ar || !(i in from)) {
        if (!ar)
          ar = Array.prototype.slice.call(from, 0, i);
        ar[i] = from[i];
      }
    }
  return to.concat(ar || Array.prototype.slice.call(from));
};
var Default9 = {
  placement: "top",
  triggerType: "hover",
  onShow: function() {
  },
  onHide: function() {
  },
  onToggle: function() {
  }
};
var Tooltip = (
  /** @class */
  function() {
    function Tooltip2(targetEl, triggerEl, options) {
      if (targetEl === void 0) {
        targetEl = null;
      }
      if (triggerEl === void 0) {
        triggerEl = null;
      }
      if (options === void 0) {
        options = Default9;
      }
      this._targetEl = targetEl;
      this._triggerEl = triggerEl;
      this._options = __assign9(__assign9({}, Default9), options);
      this._popperInstance = this._createPopperInstance();
      this._visible = false;
      this._init();
    }
    Tooltip2.prototype._init = function() {
      if (this._triggerEl) {
        this._setupEventListeners();
      }
    };
    Tooltip2.prototype._setupEventListeners = function() {
      var _this = this;
      var triggerEvents = this._getTriggerEvents();
      triggerEvents.showEvents.forEach(function(ev) {
        _this._triggerEl.addEventListener(ev, function() {
          _this.show();
        });
      });
      triggerEvents.hideEvents.forEach(function(ev) {
        _this._triggerEl.addEventListener(ev, function() {
          _this.hide();
        });
      });
    };
    Tooltip2.prototype._createPopperInstance = function() {
      return createPopper(this._triggerEl, this._targetEl, {
        placement: this._options.placement,
        modifiers: [
          {
            name: "offset",
            options: {
              offset: [0, 8]
            }
          }
        ]
      });
    };
    Tooltip2.prototype._getTriggerEvents = function() {
      switch (this._options.triggerType) {
        case "hover":
          return {
            showEvents: ["mouseenter", "focus"],
            hideEvents: ["mouseleave", "blur"]
          };
        case "click":
          return {
            showEvents: ["click", "focus"],
            hideEvents: ["focusout", "blur"]
          };
        case "none":
          return {
            showEvents: [],
            hideEvents: []
          };
        default:
          return {
            showEvents: ["mouseenter", "focus"],
            hideEvents: ["mouseleave", "blur"]
          };
      }
    };
    Tooltip2.prototype._setupKeydownListener = function() {
      var _this = this;
      this._keydownEventListener = function(ev) {
        if (ev.key === "Escape") {
          _this.hide();
        }
      };
      document.body.addEventListener("keydown", this._keydownEventListener, true);
    };
    Tooltip2.prototype._removeKeydownListener = function() {
      document.body.removeEventListener("keydown", this._keydownEventListener, true);
    };
    Tooltip2.prototype._setupClickOutsideListener = function() {
      var _this = this;
      this._clickOutsideEventListener = function(ev) {
        _this._handleClickOutside(ev, _this._targetEl);
      };
      document.body.addEventListener("click", this._clickOutsideEventListener, true);
    };
    Tooltip2.prototype._removeClickOutsideListener = function() {
      document.body.removeEventListener("click", this._clickOutsideEventListener, true);
    };
    Tooltip2.prototype._handleClickOutside = function(ev, targetEl) {
      var clickedEl = ev.target;
      if (clickedEl !== targetEl && !targetEl.contains(clickedEl) && !this._triggerEl.contains(clickedEl) && this.isVisible()) {
        this.hide();
      }
    };
    Tooltip2.prototype.isVisible = function() {
      return this._visible;
    };
    Tooltip2.prototype.toggle = function() {
      if (this.isVisible()) {
        this.hide();
      } else {
        this.show();
      }
    };
    Tooltip2.prototype.show = function() {
      this._targetEl.classList.remove("opacity-0", "invisible");
      this._targetEl.classList.add("opacity-100", "visible");
      this._popperInstance.setOptions(function(options) {
        return __assign9(__assign9({}, options), { modifiers: __spreadArray2(__spreadArray2([], options.modifiers, true), [
          { name: "eventListeners", enabled: true }
        ], false) });
      });
      this._setupClickOutsideListener();
      this._setupKeydownListener();
      this._popperInstance.update();
      this._visible = true;
      this._options.onShow(this);
    };
    Tooltip2.prototype.hide = function() {
      this._targetEl.classList.remove("opacity-100", "visible");
      this._targetEl.classList.add("opacity-0", "invisible");
      this._popperInstance.setOptions(function(options) {
        return __assign9(__assign9({}, options), { modifiers: __spreadArray2(__spreadArray2([], options.modifiers, true), [
          { name: "eventListeners", enabled: false }
        ], false) });
      });
      this._removeClickOutsideListener();
      this._removeKeydownListener();
      this._visible = false;
      this._options.onHide(this);
    };
    return Tooltip2;
  }()
);
function initTooltips() {
  document.querySelectorAll("[data-tooltip-target]").forEach(function($triggerEl) {
    var tooltipId = $triggerEl.getAttribute("data-tooltip-target");
    var $tooltipEl = document.getElementById(tooltipId);
    if ($tooltipEl) {
      var triggerType = $triggerEl.getAttribute("data-tooltip-trigger");
      var placement = $triggerEl.getAttribute("data-tooltip-placement");
      new Tooltip($tooltipEl, $triggerEl, {
        placement: placement ? placement : Default9.placement,
        triggerType: triggerType ? triggerType : Default9.triggerType
      });
    } else {
      console.error('The tooltip element with id "'.concat(tooltipId, '" does not exist. Please check the data-tooltip-target attribute.'));
    }
  });
}
if (typeof window !== "undefined") {
  window.Tooltip = Tooltip;
  window.initTooltips = initTooltips;
}
var tooltip_default = Tooltip;

// node_modules/flowbite/lib/esm/components/popover/index.js
var __assign10 = function() {
  __assign10 = Object.assign || function(t) {
    for (var s, i = 1, n = arguments.length; i < n; i++) {
      s = arguments[i];
      for (var p in s)
        if (Object.prototype.hasOwnProperty.call(s, p))
          t[p] = s[p];
    }
    return t;
  };
  return __assign10.apply(this, arguments);
};
var __spreadArray3 = function(to, from, pack) {
  if (pack || arguments.length === 2)
    for (var i = 0, l = from.length, ar; i < l; i++) {
      if (ar || !(i in from)) {
        if (!ar)
          ar = Array.prototype.slice.call(from, 0, i);
        ar[i] = from[i];
      }
    }
  return to.concat(ar || Array.prototype.slice.call(from));
};
var Default10 = {
  placement: "top",
  offset: 10,
  triggerType: "hover",
  onShow: function() {
  },
  onHide: function() {
  },
  onToggle: function() {
  }
};
var Popover = (
  /** @class */
  function() {
    function Popover2(targetEl, triggerEl, options) {
      if (targetEl === void 0) {
        targetEl = null;
      }
      if (triggerEl === void 0) {
        triggerEl = null;
      }
      if (options === void 0) {
        options = Default10;
      }
      this._targetEl = targetEl;
      this._triggerEl = triggerEl;
      this._options = __assign10(__assign10({}, Default10), options);
      this._popperInstance = this._createPopperInstance();
      this._visible = false;
      this._init();
    }
    Popover2.prototype._init = function() {
      if (this._triggerEl) {
        this._setupEventListeners();
      }
    };
    Popover2.prototype._setupEventListeners = function() {
      var _this = this;
      var triggerEvents = this._getTriggerEvents();
      triggerEvents.showEvents.forEach(function(ev) {
        _this._triggerEl.addEventListener(ev, function() {
          _this.show();
        });
        _this._targetEl.addEventListener(ev, function() {
          _this.show();
        });
      });
      triggerEvents.hideEvents.forEach(function(ev) {
        _this._triggerEl.addEventListener(ev, function() {
          setTimeout(function() {
            if (!_this._targetEl.matches(":hover")) {
              _this.hide();
            }
          }, 100);
        });
        _this._targetEl.addEventListener(ev, function() {
          setTimeout(function() {
            if (!_this._triggerEl.matches(":hover")) {
              _this.hide();
            }
          }, 100);
        });
      });
    };
    Popover2.prototype._createPopperInstance = function() {
      return createPopper(this._triggerEl, this._targetEl, {
        placement: this._options.placement,
        modifiers: [
          {
            name: "offset",
            options: {
              offset: [0, this._options.offset]
            }
          }
        ]
      });
    };
    Popover2.prototype._getTriggerEvents = function() {
      switch (this._options.triggerType) {
        case "hover":
          return {
            showEvents: ["mouseenter", "focus"],
            hideEvents: ["mouseleave", "blur"]
          };
        case "click":
          return {
            showEvents: ["click", "focus"],
            hideEvents: ["focusout", "blur"]
          };
        case "none":
          return {
            showEvents: [],
            hideEvents: []
          };
        default:
          return {
            showEvents: ["mouseenter", "focus"],
            hideEvents: ["mouseleave", "blur"]
          };
      }
    };
    Popover2.prototype._setupKeydownListener = function() {
      var _this = this;
      this._keydownEventListener = function(ev) {
        if (ev.key === "Escape") {
          _this.hide();
        }
      };
      document.body.addEventListener("keydown", this._keydownEventListener, true);
    };
    Popover2.prototype._removeKeydownListener = function() {
      document.body.removeEventListener("keydown", this._keydownEventListener, true);
    };
    Popover2.prototype._setupClickOutsideListener = function() {
      var _this = this;
      this._clickOutsideEventListener = function(ev) {
        _this._handleClickOutside(ev, _this._targetEl);
      };
      document.body.addEventListener("click", this._clickOutsideEventListener, true);
    };
    Popover2.prototype._removeClickOutsideListener = function() {
      document.body.removeEventListener("click", this._clickOutsideEventListener, true);
    };
    Popover2.prototype._handleClickOutside = function(ev, targetEl) {
      var clickedEl = ev.target;
      if (clickedEl !== targetEl && !targetEl.contains(clickedEl) && !this._triggerEl.contains(clickedEl) && this.isVisible()) {
        this.hide();
      }
    };
    Popover2.prototype.isVisible = function() {
      return this._visible;
    };
    Popover2.prototype.toggle = function() {
      if (this.isVisible()) {
        this.hide();
      } else {
        this.show();
      }
      this._options.onToggle(this);
    };
    Popover2.prototype.show = function() {
      this._targetEl.classList.remove("opacity-0", "invisible");
      this._targetEl.classList.add("opacity-100", "visible");
      this._popperInstance.setOptions(function(options) {
        return __assign10(__assign10({}, options), { modifiers: __spreadArray3(__spreadArray3([], options.modifiers, true), [
          { name: "eventListeners", enabled: true }
        ], false) });
      });
      this._setupClickOutsideListener();
      this._setupKeydownListener();
      this._popperInstance.update();
      this._visible = true;
      this._options.onShow(this);
    };
    Popover2.prototype.hide = function() {
      this._targetEl.classList.remove("opacity-100", "visible");
      this._targetEl.classList.add("opacity-0", "invisible");
      this._popperInstance.setOptions(function(options) {
        return __assign10(__assign10({}, options), { modifiers: __spreadArray3(__spreadArray3([], options.modifiers, true), [
          { name: "eventListeners", enabled: false }
        ], false) });
      });
      this._removeClickOutsideListener();
      this._removeKeydownListener();
      this._visible = false;
      this._options.onHide(this);
    };
    return Popover2;
  }()
);
function initPopovers() {
  document.querySelectorAll("[data-popover-target]").forEach(function($triggerEl) {
    var popoverID = $triggerEl.getAttribute("data-popover-target");
    var $popoverEl = document.getElementById(popoverID);
    if ($popoverEl) {
      var triggerType = $triggerEl.getAttribute("data-popover-trigger");
      var placement = $triggerEl.getAttribute("data-popover-placement");
      var offset = $triggerEl.getAttribute("data-popover-offset");
      new Popover($popoverEl, $triggerEl, {
        placement: placement ? placement : Default10.placement,
        offset: offset ? parseInt(offset) : Default10.offset,
        triggerType: triggerType ? triggerType : Default10.triggerType
      });
    } else {
      console.error('The popover element with id "'.concat(popoverID, '" does not exist. Please check the data-popover-target attribute.'));
    }
  });
}
if (typeof window !== "undefined") {
  window.Popover = Popover;
  window.initPopovers = initPopovers;
}
var popover_default = Popover;

// node_modules/flowbite/lib/esm/components/dial/index.js
var __assign11 = function() {
  __assign11 = Object.assign || function(t) {
    for (var s, i = 1, n = arguments.length; i < n; i++) {
      s = arguments[i];
      for (var p in s)
        if (Object.prototype.hasOwnProperty.call(s, p))
          t[p] = s[p];
    }
    return t;
  };
  return __assign11.apply(this, arguments);
};
var Default11 = {
  triggerType: "hover",
  onShow: function() {
  },
  onHide: function() {
  },
  onToggle: function() {
  }
};
var Dial = (
  /** @class */
  function() {
    function Dial2(parentEl, triggerEl, targetEl, options) {
      if (parentEl === void 0) {
        parentEl = null;
      }
      if (triggerEl === void 0) {
        triggerEl = null;
      }
      if (targetEl === void 0) {
        targetEl = null;
      }
      if (options === void 0) {
        options = Default11;
      }
      this._parentEl = parentEl;
      this._triggerEl = triggerEl;
      this._targetEl = targetEl;
      this._options = __assign11(__assign11({}, Default11), options);
      this._visible = false;
      this._init();
    }
    Dial2.prototype._init = function() {
      var _this = this;
      if (this._triggerEl) {
        var triggerEventTypes = this._getTriggerEventTypes(this._options.triggerType);
        triggerEventTypes.showEvents.forEach(function(ev) {
          _this._triggerEl.addEventListener(ev, function() {
            _this.show();
          });
          _this._targetEl.addEventListener(ev, function() {
            _this.show();
          });
        });
        triggerEventTypes.hideEvents.forEach(function(ev) {
          _this._parentEl.addEventListener(ev, function() {
            if (!_this._parentEl.matches(":hover")) {
              _this.hide();
            }
          });
        });
      }
    };
    Dial2.prototype.hide = function() {
      this._targetEl.classList.add("hidden");
      if (this._triggerEl) {
        this._triggerEl.setAttribute("aria-expanded", "false");
      }
      this._visible = false;
      this._options.onHide(this);
    };
    Dial2.prototype.show = function() {
      this._targetEl.classList.remove("hidden");
      if (this._triggerEl) {
        this._triggerEl.setAttribute("aria-expanded", "true");
      }
      this._visible = true;
      this._options.onShow(this);
    };
    Dial2.prototype.toggle = function() {
      if (this._visible) {
        this.hide();
      } else {
        this.show();
      }
    };
    Dial2.prototype.isHidden = function() {
      return !this._visible;
    };
    Dial2.prototype.isVisible = function() {
      return this._visible;
    };
    Dial2.prototype._getTriggerEventTypes = function(triggerType) {
      switch (triggerType) {
        case "hover":
          return {
            showEvents: ["mouseenter", "focus"],
            hideEvents: ["mouseleave", "blur"]
          };
        case "click":
          return {
            showEvents: ["click", "focus"],
            hideEvents: ["focusout", "blur"]
          };
        case "none":
          return {
            showEvents: [],
            hideEvents: []
          };
        default:
          return {
            showEvents: ["mouseenter", "focus"],
            hideEvents: ["mouseleave", "blur"]
          };
      }
    };
    return Dial2;
  }()
);
function initDials() {
  document.querySelectorAll("[data-dial-init]").forEach(function($parentEl) {
    var $triggerEl = $parentEl.querySelector("[data-dial-toggle]");
    if ($triggerEl) {
      var dialId = $triggerEl.getAttribute("data-dial-toggle");
      var $dialEl = document.getElementById(dialId);
      if ($dialEl) {
        var triggerType = $triggerEl.getAttribute("data-dial-trigger");
        new Dial($parentEl, $triggerEl, $dialEl, {
          triggerType: triggerType ? triggerType : Default11.triggerType
        });
      } else {
        console.error("Dial with id ".concat(dialId, " does not exist. Are you sure that the data-dial-toggle attribute points to the correct modal id?"));
      }
    } else {
      console.error("Dial with id ".concat($parentEl.id, " does not have a trigger element. Are you sure that the data-dial-toggle attribute exists?"));
    }
  });
}
if (typeof window !== "undefined") {
  window.Dial = Dial;
  window.initDials = initDials;
}
var dial_default = Dial;

// node_modules/flowbite/lib/esm/components/index.js
function initFlowbite() {
  initAccordions();
  initCollapses();
  initCarousels();
  initDismisses();
  initDropdowns();
  initModals();
  initDrawers();
  initTabs();
  initTooltips();
  initPopovers();
  initDials();
}
if (typeof window !== "undefined") {
  window.initFlowbite = initFlowbite;
}

// node_modules/flowbite/lib/esm/index.js
var events = new events_default("load", [
  initAccordions,
  initCollapses,
  initCarousels,
  initDismisses,
  initDropdowns,
  initModals,
  initDrawers,
  initTabs,
  initTooltips,
  initPopovers,
  initDials
]);
events.init();
export {
  accordion_default as Accordion,
  carousel_default as Carousel,
  collapse_default as Collapse,
  dial_default as Dial,
  dismiss_default as Dismiss,
  drawer_default as Drawer,
  dropdown_default as Dropdown,
  modal_default as Modal,
  popover_default as Popover,
  tabs_default as Tabs,
  tooltip_default as Tooltip,
  initAccordions,
  initCarousels,
  initCollapses,
  initDials,
  initDismisses,
  initDrawers,
  initDropdowns,
  initFlowbite,
  initModals,
  initPopovers,
  initTabs,
  initTooltips
};
//# sourceMappingURL=flowbite.js.map
