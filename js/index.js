document.querySelector('.notif').addEventListener('click', () => {
  alert('Kamu punya 2 notifikasi baru 🔔');
});

document.querySelectorAll('.buy-btn').forEach(button => {
  button.addEventListener('click', () => {
    button.textContent = "✔️ Dibeli!";
    button.style.backgroundColor = "#10b981";
    setTimeout(() => {
      button.textContent = "Beli";
      button.style.backgroundColor = "#3b82f6";
    }, 1500);
  });
});
