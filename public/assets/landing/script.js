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

// Toast helper
const toastContainer = document.createElement('div');
toastContainer.className = 'toast-container';
document.body.appendChild(toastContainer);

function showToast(message, type = 'info') {
  const toast = document.createElement('div');
  toast.className = `toast ${type}`;
  toast.innerText = message;
  toastContainer.appendChild(toast);

  requestAnimationFrame(() => toast.classList.add('visible'));

  setTimeout(() => {
    toast.classList.remove('visible');
    toast.addEventListener('transitionend', () => toast.remove(), { once: true });
  }, 4000);
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
      showToast('Mohon lengkapi seluruh data wajib sebelum mengirim.', 'error');
      return false;
    }

    // Form will submit normally to Laravel route
    // No need to prevent default, let it submit naturally
  });
}

// Prevent any alert() calls that might be triggered on register page
// Override window.alert to suppress registration-related alerts
(function() {
  const originalAlert = window.alert;
  window.alert = function(message) {
    // Suppress registration success alerts
    if (message && (
      message.includes('Terima kasih') || 
      message.includes('Pendaftaran Anda kami terima') ||
      message.includes('pendaftaran berhasil')
    )) {
      return; // Suppress this alert
    }
    // Allow other alerts (errors, etc.)
    return originalAlert.apply(window, arguments);
  };
})();

// Parallax hero effect
const heroVisual = document.querySelector('.hero-visual');
if (heroVisual) {
  window.addEventListener('scroll', () => {
    const offset = window.scrollY;
    heroVisual.style.transform = `translateY(${offset * 0.1}px)`;
  });
}

// Global image lightbox
const images = document.querySelectorAll('img:not([data-no-lightbox])');
if (images.length) {
  const lightboxOverlay = document.createElement('div');
  lightboxOverlay.className = 'image-lightbox';
  lightboxOverlay.innerHTML = `
    <div class="image-lightbox__content">
      <button class="image-lightbox__close" aria-label="Tutup gambar">&times;</button>
      <img alt="Preview gambar" />
      <p class="image-lightbox__caption"></p>
    </div>
  `;
  document.body.appendChild(lightboxOverlay);

  const lightboxImage = lightboxOverlay.querySelector('img');
  const lightboxCaption = lightboxOverlay.querySelector('.image-lightbox__caption');
  const closeButton = lightboxOverlay.querySelector('.image-lightbox__close');

  function closeLightbox() {
    lightboxOverlay.classList.remove('show');
    document.body.style.overflow = '';
  }

  function openLightbox(src, altText) {
    lightboxImage.src = src;
    lightboxCaption.textContent = altText || 'Preview gambar';
    lightboxOverlay.classList.add('show');
    document.body.style.overflow = 'hidden';
  }

  images.forEach(img => {
    img.style.cursor = 'zoom-in';
    img.addEventListener('click', () => {
      openLightbox(img.src, img.alt);
    });
  });

  closeButton.addEventListener('click', closeLightbox);
  lightboxOverlay.addEventListener('click', e => {
    if (e.target === lightboxOverlay) {
      closeLightbox();
    }
  });

  document.addEventListener('keyup', e => {
    if (e.key === 'Escape' && lightboxOverlay.classList.contains('show')) {
      closeLightbox();
    }
  });
}

