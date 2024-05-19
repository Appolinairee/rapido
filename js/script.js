let addButtons = document.querySelectorAll(".addButton");
let addCourses = document.querySelectorAll(".addCourse");
let overflows = document.querySelectorAll(".overflow");
let undisplayModals = document.querySelectorAll(".undisplayModal");

const displayModal = (modal) => {
    modal.style.display = 'block';
    document.body.style.overflow = 'hidden';
};

const removeModal = (modal) => {
    modal.style.display = 'none';
    document.body.style.overflow = 'auto';
};


addButtons.forEach((button, index) => {
    button.addEventListener('click', () => {
        console.log("Je suis", addCourses);
        displayModal(addCourses[index]);
        displayModal(overflows[index]);
    });
});


addButtons.forEach((button, index) => {
    button.addEventListener('click', () => {
        displayModal(addCourses[index]);
        displayModal(overflows[index]);
    });
});


undisplayModals.forEach((button, index) => {
    button.addEventListener('click', () => {
        console.log(index, addCourses)
        removeModal(addCourses[index]);
        removeModal(overflows[index]);
    });
});

overflows.forEach((overlay, index) => {
    overlay.addEventListener('click', () => {
        removeModal(addCourses[index]);
        removeModal(overflows[index]);
    });
});