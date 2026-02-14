import { animate, stagger, inView } from "motion";

// Fade in up animation for single elements
const fadeInUp = (element, delay = 0) => {
    animate(
        element,
        { opacity: [0, 1], y: [20, 0] },
        { duration: 0.5, delay: delay, easing: "ease-out" }
    );
};

// Staggered animation for lists
const staggerList = (selector, delay = 0.1) => {
    inView(selector, (info) => {
        animate(
            info.target,
            { opacity: [0, 1], y: [20, 0] },
            { duration: 0.4, delay: stagger(delay), easing: "ease-out" }
        );
    });
};

// Scale on hover (programmatic, though CSS is often better for simple hover)
const hoverScale = (selector) => {
    const elements = document.querySelectorAll(selector);
    elements.forEach(el => {
        el.addEventListener("mouseenter", () => {
             animate(el, { scale: 1.02 }, { duration: 0.2 });
        });
        el.addEventListener("mouseleave", () => {
             animate(el, { scale: 1 }, { duration: 0.2 });
        });
    });
};

// Initialize animations based on data attributes
document.addEventListener("DOMContentLoaded", () => {
    // Elements with data-animate="fade-in-up"
    document.querySelectorAll('[data-animate="fade-in-up"]').forEach((el, index) => {
        fadeInUp(el, index * 0.1);
    });

    // Lists with data-animate="stagger"
    // We expect the parent to have this, and children to be the targets
    // actually motion one's stagger works on a collection. 
    // Let's assume we pass the CLASS of the items to stagger
    
    // Auto-init for common patterns
    inView('[data-animate="stagger-children"] > *', (info) => {
         animate(
            info.target, 
            { opacity: [0, 1], y: [20, 0] }, 
            { duration: 0.5 }
        );
    });
});

export { fadeInUp, staggerList, hoverScale };
