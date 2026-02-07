(function() {
  // Theme switching functionality
  function setTheme(theme) {
    document.body.classList.remove('theme-geocities', 'theme-flash');
    if (theme !== 'default') {
      document.body.classList.add('theme-' + theme);
    }
    // Set visitor count for geocities theme
    if (theme === 'geocities') {
      var visitorCount = Math.floor(Math.random() * 9000) + 1000;
      document.body.setAttribute('data-visitor', visitorCount);
    }
    // Update active state in dropdown
    document.querySelectorAll('.theme-dropdown .dropdown-menu li').forEach(function(li) {
      li.classList.remove('active');
      if (li.getAttribute('data-theme') === theme) {
        li.classList.add('active');
      }
    });
    // Save preference
    localStorage.setItem('selectedTheme', theme);
  }

  // Load saved theme on page load
  document.addEventListener('DOMContentLoaded', function() {
    var savedTheme = localStorage.getItem('selectedTheme') || 'default';
    setTheme(savedTheme);

    // Add click handlers to theme options
    document.querySelectorAll('.theme-dropdown .dropdown-menu li').forEach(function(li) {
      li.addEventListener('click', function(e) {
        e.preventDefault();
        var theme = this.getAttribute('data-theme');
        setTheme(theme);
      });
    });
  });
})();
