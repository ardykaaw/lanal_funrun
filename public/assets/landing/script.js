const countdownEl = document.getElementById('countdown');
const targetDate = new Date('2025-12-21T06:00:00+08:00').getTime();

function updateCountdown() {
  if (!countdownEl) return;
  const now = new Date().getTime();
  const diff = targetDate - now;

  if (diff <= 0) {
    countdownEl.innerHTML = '<p>Lari sudah dimulai! Sampai di garis start!</p>';
    return;
  }

  const days = Math.floor(diff / (1000 * 60 * 60 * 24));
  const hours = Math.floor((diff / (1000 * 60 * 60)) % 24);
  const minutes = Math.floor((diff / (1000 * 60)) % 60);
  const seconds = Math.floor((diff / 1000) % 60);

  countdownEl.innerHTML = `
    <div class="time">
      <strong>${String(days).padStart(2, '0')}</strong>
      <span>Hari</span>
    </div>
    <div class="time">
      <strong>${String(hours).padStart(2, '0')}</strong>
      <span>Jam</span>
    </div>
    <div class="time">
      <strong>${String(minutes).padStart(2, '0')}</strong>
      <span>Menit</span>
    </div>
    <div class="time">
      <strong>${String(seconds).padStart(2, '0')}</strong>
      <span>Detik</span>
    </div>
  `;
}

setInterval(updateCountdown, 1000);
updateCountdown();

// Scroll animations
const observer = new IntersectionObserver(
  entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('show');
        observer.unobserve(entry.target);
      }
    });
  },
  { threshold: 0.2 }
);

document.querySelectorAll('.fade').forEach(el => {
  if (el.dataset.delay) {
    el.style.transitionDelay = `${el.dataset.delay}s`;
  }
  observer.observe(el);
});

// FAQ accordion
document.querySelectorAll('.faq-item').forEach(item => {
  const question = item.querySelector('.faq-question');
  if (!question) return;
  question.addEventListener('click', () => {
    item.classList.toggle('active');
  });
});

// Mobile menu toggle
const mobileToggle = document.querySelector('.mobile-toggle');
const navLinks = document.querySelector('.nav-links');

if (mobileToggle && navLinks) {
  mobileToggle.addEventListener('click', () => {
    navLinks.classList.toggle('open');
  });

  navLinks.querySelectorAll('a').forEach(link => {
    link.addEventListener('click', () => {
      navLinks.classList.remove('open');
    });
  });
}

// Basic form validation on register page
const registerForm = document.querySelector('#register-form');
if (registerForm) {
  registerForm.addEventListener('submit', e => {
    const required = registerForm.querySelectorAll('[required]');
    let valid = true;

    required.forEach(field => {
      if (!field.value.trim()) {
        valid = false;
        field.classList.add('error');
        field.setAttribute('aria-invalid', 'true');
      } else {
        field.classList.remove('error');
        field.removeAttribute('aria-invalid');
      }
    });

    if (!valid) {
      e.preventDefault();
      alert('Mohon lengkapi seluruh data wajib.');
    } else {
      alert('Terima kasih! Pendaftaran Anda kami terima.');
    }
  });
}

// Parallax hero effect
const heroVisual = document.querySelector('.hero-visual');
if (heroVisual) {
  window.addEventListener('scroll', () => {
    const offset = window.scrollY;
    heroVisual.style.transform = `translateY(${offset * 0.1}px)`;
  });
}

