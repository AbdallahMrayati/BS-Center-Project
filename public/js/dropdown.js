document.addEventListener("DOMContentLoaded", () => {
  const categoryDropDown = document.querySelector(".category-drop-down");
  const courseDropDown = document.querySelector(".course-drop-down");
  const categoryList = document.querySelector(".category-list");
  const courseList = document.querySelector(".course-list");

  // Toggle dropdown lists
  categoryDropDown.addEventListener("click", () => {
    categoryList.classList.toggle("show-list");
  });

  courseDropDown.addEventListener("click", () => {
    courseList.classList.toggle("show-list");
  });

  // Event delegation for list items
  document.addEventListener("click", (event) => {
    const clickedElement = event.target;

    if (clickedElement.closest(".category-list li")) {
      const selectedText = clickedElement.innerHTML;
      document.getElementById("category").value = selectedText;
      categoryList.classList.remove("show-list");
    } else if (clickedElement.closest(".course-list li")) {
      const selectedText = clickedElement.innerHTML;
      document.getElementById("course").value = selectedText;
      courseList.classList.remove("show-list");
    } else {
      // Close dropdown lists if clicked outside
      if (!clickedElement.closest(".drop-down")) {
        categoryList.classList.remove("show-list");
        courseList.classList.remove("show-list");
      }
    }
  });
});
