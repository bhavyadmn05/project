function toggleAnswer(index) {
    const answers = document.querySelectorAll('.faq-answer');
    const icons = document.querySelectorAll('.toggle-icon');
    
    // Toggle the answer visibility
    const answer = answers[index];
    const icon = icons[index];
    
    if (answer.style.display === 'block') {
        answer.style.display = 'none';
        icon.textContent = '+';
    } else {
        answer.style.display = 'block';
        icon.textContent = '-';
    }
}