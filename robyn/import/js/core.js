var Core = {};
// W3C DOM 2 Events model
if (document.addEventListener) {
	Core.addEventListener = function(target, type, listener) {
		target.addEventListener(type, listener, false);
	};
	Core.removeEventListener = function(target, type, listener) {
	 target.removeEventListener(type, listener, false);
	};
	Core.preventDefault = function(event) {
	 event.preventDefault();
	};
	Core.stopPropagation = function(event) {
	event.stopPropagation();
	};
}
// Internet Explorer Events model
else if (document.attachEvent) {
	
	Core.addEventListener = function(target, type, listener) {
		if (Core._findListener(target, type, listener) != -1)
			return;
		var listener2 = function() 	{
			var event = window.event;
			if (Function.prototype.call) {
				listener.call(target, event);
			}
			else {
				target._currentListener = listener;
				target._currentListener(event)
				target._currentListener = null;
			}
		};
		target.attachEvent("on" + type, listener2);
		var listenerRecord = {
			target: target,
			type: type,
			listener: listener,
			listener2: listener2
		};
		var targetDocument = target.document || target;
		var targetWindow = targetDocument.parentWindow;
		var listenerId = "l" + Core._listenerCounter++;
		if (!targetWindow._allListeners)
			targetWindow._allListeners = {};
		targetWindow._allListeners[listenerId] = listenerRecord;
		if (!target._listeners)
			target._listeners = [];
		target._listeners[target._listeners.length] = listenerId;
		if (!targetWindow._unloadListenerAdded)	{
			targetWindow._unloadListenerAdded = true;
			targetWindow.attachEvent("onunload", Core._removeAllListeners);
		}
	};
	Core.removeEventListener = function(target, type, listener)	{
		var listenerIndex = Core._findListener(target, type, listener);
		if (listenerIndex == -1)
			return;
		var targetDocument = target.document || target;
		var targetWindow = targetDocument.parentWindow;
		var listenerId = target._listeners[listenerIndex];
		var listenerRecord = targetWindow._allListeners[listenerId];
		target.detachEvent("on" + type, listenerRecord.listener2);
		target._listeners.splice(listenerIndex, 1);
		delete targetWindow._allListeners[listenerId];
	};
	Core.preventDefault = function(event)	{
		event.returnValue = false;
	};
	Core.stopPropagation = function(event) {
		event.cancelBubble = true;
	};
	Core._findListener = function(target, type, listener)	{
		var listeners = target._listeners;
		if (!listeners)
			return -1;
		var targetDocument = target.document || target;
		var targetWindow = targetDocument.parentWindow;
		for (var i = listeners.length - 1; i >= 0; i--) {
			var listenerId = listeners[i];
			var listenerRecord =
			targetWindow._allListeners[listenerId];
			if (listenerRecord.type == type && listenerRecord.listener == listener) {
				return i;
			}
		}
		return -1;
	};
	Core._removeAllListeners = function()	{
		var targetWindow = this;
		for (id in targetWindow._allListeners) {
			var listenerRecord = targetWindow._allListeners[id];
			listenerRecord.target.detachEvent("on" + listenerRecord.type, listenerRecord.listener2);
			delete targetWindow._allListeners[id];
		}
	};
	Core._listenerCounter = 0;
}
Core.addClass = function(target, theClass) {
	if (!Core.hasClass(target, theClass)) {
		if (target.className == "") {
			target.className = theClass;
		}
		else {
			target.className += " " + theClass;
		}
	}
};
Core.getElementsByClass = function(theClass) {
	var elementArray = [];
	if (document.all) {
		elementArray = document.all;
	}
	else {
		elementArray = document.getElementsByTagName("*");
	}
	var matchedArray = [];
	var pattern = new RegExp("(^| )" + theClass + "( |$)");
	for (var i = 0; i < elementArray.length; i++) {
		if (pattern.test(elementArray[i].className)) {
			matchedArray[matchedArray.length] = elementArray[i];
		}
	}
	return matchedArray;
};
Core.hasClass = function(target, theClass) {
	var pattern = new RegExp("(^| )" + theClass + "( |$)");
	if (pattern.test(target.className)) {
		return true;
	}
	return false;
};
Core.removeClass = function(target, theClass) {
	var pattern = new RegExp("(^| )" + theClass + "( |$)");
	target.className = target.className.replace(pattern, "$1");
	target.className = target.className.replace(/ $/, "");
};
Core.getComputedStyle = function(element, styleProperty) {
	var computedStyle = null;
	if (typeof element.currentStyle != "undefined") {
		computedStyle = element.currentStyle;
	}
	else {
		computedStyle = document.defaultView.getComputedStyle(element, null);
	}
	return computedStyle[styleProperty];
};
Core.start = function(runnable) {
	var initOnce = function() {
		if (arguments.callee.done) return;
		arguments.callee.done = true;
		runnable.init();
	};
	Core.addEventListener(document, "DOMContentLoaded", initOnce);
	Core.addEventListener(window, "load", initOnce);
};
Core.repaint = function() {
	document.documentElement.style.position = "relative";
};
Core.emptyElement = function(target) {
	while(target.hasChildNodes()) {
		target.removeChild(target.lastChild);
	}
};
$ = function(elm) {	return document.getElementById(elm) };