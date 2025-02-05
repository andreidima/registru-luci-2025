// resources/js/directives/clickOutside.js

export const clickOutside = {
    beforeMount(el, binding) {
        el.clickOutsideEvent = (event) => {
            // If the event was stopped, do nothing (we handle it inside Vue)
            if (event.stopHandled) {
                return;
            }

            // If the click is outside the component, run the bound method
            if (!(el === event.target || el.contains(event.target))) {
                binding.value(event);
            }
        };
        document.addEventListener("click", el.clickOutsideEvent);
    },
    unmounted(el) {
        document.removeEventListener("click", el.clickOutsideEvent);
    },
};
