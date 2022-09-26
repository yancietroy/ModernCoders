function createRipple(event) {
  const button = event.currentTarget;
  const btnRect = button.getBoundingClientRect();
  const circle = document.createElement("span");
  const diameter = Math.max(btnRect.width, btnRect.height);
  const radius = diameter / 2;

  circle.style.width = circle.style.height = `${diameter}px`;
  circle.style.left = `${event.clientX - (btnRect.left + radius)}px`;
  circle.style.top = `${event.clientY - (btnRect.top + radius)}px`;
  circle.classList.add("ripple");

  const ripple = button.getElementsByClassName("ripple")[0];

  if (ripple) {
    ripple.remove();
  }

  button.appendChild(circle);
}

const buttons = document.getElementsByClassName("ct-link-button");

for (const button of buttons) {
  button.addEventListener("click", createRipple);
}
