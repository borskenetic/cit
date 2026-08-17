document.addEventListener('DOMContentLoaded', () => {
  const searchInput = document.getElementById('searchInput');
  const clearBtn = document.getElementById('clearBtn');
  const searchForm = document.getElementById('opacSearchForm');
  const menuToggle = document.getElementById('menuToggle');
  const navLinks = document.getElementById('navLinks');
  const video = document.querySelector('.responsive-video');

  // 1. Mobile Menu Toggle
  if (menuToggle && navLinks) {
    menuToggle.addEventListener('click', () => {
      navLinks.classList.toggle('active');
    });
  }

  // 2. Clear Search Input Logic
  if (searchInput && clearBtn) {
    searchInput.addEventListener('input', () => {
      clearBtn.style.display = searchInput.value.trim().length > 0 ? 'block' : 'none';
    });

    clearBtn.addEventListener('click', () => {
      searchInput.value = '';
      clearBtn.style.display = 'none';
      searchInput.focus();
    });
  }

  // 3. Search Form Submit
  if (searchForm) {
    searchForm.addEventListener('submit', (e) => {
      e.preventDefault();
      const query = searchInput.value.trim();
      if (query) {
        alert(`Searching OPAC catalog for: "${query}"`);
      }
    });
  }

  // 4. Autoplay Video Once on Scroll Into View
  if (video) {
    const observer = new IntersectionObserver((entries, observerInstance) => {
      entries.forEach(entry => {
        // Triggers when at least 50% of the video is visible in the viewport
        if (entry.isIntersecting) {
          // Unmute first if you want sound, but browsers require videos to be muted for autoplay
          video.play().then(() => {
            console.log('Video autoplayed successfully on scroll');
          }).catch(error => {
            console.warn('Autoplay prevented by browser rules. Video must be muted to autoplay:', error);
          });

          // Disconnect the observer so it only triggers ONCE
          observerInstance.unobserve(entry.target);
        }
      });
    }, {
      threshold: 0.5 // 50% visibility required before playing
    });

    observer.observe(video);
  }
});