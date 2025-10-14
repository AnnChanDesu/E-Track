document.addEventListener('DOMContentLoaded', function () {
  // ----------------- Notifications -----------------
  const notifLink = document.querySelector('.nav-link.active, .nav-link');

  const notifListContainer = document.createElement('ul');
  notifListContainer.className = 'notifications-list';
  notifListContainer.style.display = 'none';
  notifListContainer.style.position = 'absolute';
  notifListContainer.style.right = '0';
  notifListContainer.style.top = '60px';
  notifListContainer.style.background = '#fff5f0'; // light background for palette
  notifListContainer.style.color = '#333';
  notifListContainer.style.borderRadius = '8px';
  notifListContainer.style.padding = '10px';
  notifListContainer.style.minWidth = '250px';
  notifListContainer.style.boxShadow = '0 4px 8px rgba(230,133,83,0.3)'; // soft shadow
  notifListContainer.style.zIndex = '1000';
  notifListContainer.style.listStyle = 'none';

  const topRight = document.querySelector('.top-right');
  topRight.appendChild(notifListContainer);

  const notifBadge = document.createElement('span');
  notifBadge.id = 'notif-count';
  notifBadge.style.background = '#782800ff'; // main color
  notifBadge.style.color = '#fff';
  notifBadge.style.fontSize = '0.8rem';
  notifBadge.style.padding = '2px 6px';
  notifBadge.style.borderRadius = '50%';
  notifBadge.style.marginLeft = '5px';
  notifBadge.textContent = '0';
  notifLink.appendChild(notifBadge);

  let notifications = [
    { msg: "FRONT END READY", time: "2025-09-28 16:00" },
    { msg: "EXPECT FULL FUNCTIONAL LATER", time: "2025-09-28 16:30" },
    { msg: "DELIVERED NA", time: "2025-09-28 17:00" }
  ];

  function updateNotifList() {
    notifListContainer.innerHTML = '';
    notifications.forEach(notif => {
      const li = document.createElement('li');
      li.style.padding = '5px 0';
      li.style.borderBottom = '1px solid #f06a27'; // subtle divider
      li.style.fontWeight = '500';
      li.innerHTML = `<strong style="color:#e68553;">${notif.msg}</strong><br><small style="color: #a65c33;">${notif.time}</small>`;
      notifListContainer.appendChild(li);
    });
    notifBadge.textContent = notifications.length;
  }

  updateNotifList();

  notifLink.addEventListener('click', function (e) {
    e.preventDefault();
    notifListContainer.style.display = notifListContainer.style.display === 'none' ? 'block' : 'none';
    if (notifListContainer.style.display === 'block') notifBadge.textContent = '0';
  });

  document.addEventListener('click', function(e) {
    if (!notifListContainer.contains(e.target) && e.target !== notifLink) {
      notifListContainer.style.display = 'none';
    }
  });

  window.addNotification = function(msg) {
    const now = new Date();
    const timestamp = now.getFullYear() + "-" +
                      String(now.getMonth()+1).padStart(2,'0') + "-" +
                      String(now.getDate()).padStart(2,'0') + " " +
                      String(now.getHours()).padStart(2,'0') + ":" +
                      String(now.getMinutes()).padStart(2,'0');
    notifications.push({ msg: msg, time: timestamp });
    updateNotifList();
    notifListContainer.style.display = 'block';
  };

  // ----------------- Status Filter -----------------
  const statusFilter = document.getElementById('status-filter');
  const docTable = document.querySelector('.documents-table tbody');

  if (statusFilter && docTable) {
    statusFilter.addEventListener('change', function () {
      const selectedStatus = this.value.toLowerCase();
      Array.from(docTable.rows).forEach(row => {
        const statusCell = row.cells[2]; // Status is 3rd column (0-indexed)
        const rowStatus = statusCell.textContent.toLowerCase();
        row.style.display = selectedStatus === 'all' || rowStatus === selectedStatus ? '' : 'none';
      });
    });
  }

  // ----------------- Track Button Modal -----------------
  const trackModal = document.getElementById('track-modal');
  const trackInfo = document.getElementById('track-info');
  const closeBtn = document.querySelector('.close-btn');

  // Sample tracking data with full history
  const trackingData = [
    {
      id: "1",
      history: [
        { status: "Pending", timestamp: "2025-09-28 16:00" }
      ]
    },
    {
      id: "2",
      history: [
        { status: "Pending", timestamp: "2025-09-24 10:00" },
        { status: "Approved", timestamp: "2025-09-25 09:15" },
        { status: "Released", timestamp: "2025-09-25 14:30" }
      ]
    }
  ];

  const trackButtons = document.querySelectorAll('.track-btn');
  trackButtons.forEach(btn => {
    btn.addEventListener('click', function () {
      const row = btn.closest('tr');
      const docId = row.cells[0].textContent.trim();
      const track = trackingData.find(d => d.id === docId);
      if (track && track.history.length > 0) {
        trackInfo.innerHTML = '<strong style="color:#f06a27;">Status History:</strong><br>';
        track.history.forEach(h => {
          trackInfo.innerHTML += `• <strong style="color:#f06a27;">${h.status}</strong> - <span style="color:#a65c33;">${h.timestamp}</span><br>`;
        });
      } else {
        trackInfo.textContent = "No tracking data available.";
      }
      trackModal.style.display = 'flex';
    });
  });

  closeBtn.addEventListener('click', function() {
    trackModal.style.display = 'none';
  });

  window.addEventListener('click', function(e) {
    if (e.target === trackModal) trackModal.style.display = 'none';
  });
});
