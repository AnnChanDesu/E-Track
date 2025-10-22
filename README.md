<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>E-Track: Document Tracking System — README</title>
  <style>
    :root{
      --bg:#f7f8fb; --card:#ffffff; --muted:#6b7280; --accent:#0b69ff;
      --maxw:900px; --pad:20px;
    }
    html,body{height:100%;}
    body{
      margin:0; font-family:Inter, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
      background:linear-gradient(180deg,#f2f6ff 0%,var(--bg) 100%); color:#0f172a;
      display:flex; align-items:flex-start; justify-content:center; padding:40px 16px;
    }
    .container{
      max-width:var(--maxw); width:100%; background:var(--card);
      border-radius:12px; box-shadow:0 10px 30px rgba(12,20,40,0.08);
      padding:calc(var(--pad) * 1.25);
    }
    header h1{margin:0 0 4px 0; font-size:1.6rem;}
    header p{margin:0; color:var(--muted); font-size:0.94rem;}
    .meta{margin-top:8px; color:var(--muted); font-size:0.92rem;}
    nav.toc{margin-top:18px; padding:12px; background:#f8fbff; border-radius:8px;}
    nav.toc a{display:inline-block; margin:6px 10px 6px 0; color:var(--accent); text-decoration:none; font-weight:600;}
    section{margin-top:20px; line-height:1.6;}
    h2{font-size:1.05rem; margin:18px 0 8px 0;}
    p.lead{color:var(--muted);}
    table{width:100%; border-collapse:collapse; margin-top:8px;}
    table th, table td{padding:10px 8px; border:1px solid #edf2f7; text-align:left; vertical-align:top;}
    table th{background:#fbfdff; font-weight:700;}
    .wireframes .placeholder{height:140px; border-radius:8px; background:linear-gradient(90deg,#eef5ff,#ffffff); display:flex; align-items:center; justify-content:center; color:var(--muted); border:1px dashed #e6eefc;}
    footer{margin-top:26px; color:var(--muted); font-size:0.85rem;}
    pre.code{background:#0f172a;color:#fff;padding:12px;border-radius:8px;overflow:auto;font-size:0.86rem;}
    @media (max-width:600px){ .container{padding:14px;} header h1{font-size:1.25rem;} }
  </style>
</head>
<body>
  <div class="container" role="main">
    <header>
      <h1>E-Track: Document Tracking System (DTS)</h1>
      <p class="lead">A web-based tool to upload, send, track, and retrieve documents securely — replaces manual/paper tracking with transparent, auditable workflows.</p>
      <div class="meta">Submitted: BSIT - 4B · December 2024</div>
    </header>

    <nav class="toc" aria-label="Table of Contents">
      <strong>Table of Contents</strong><br />
      <a href="#overview">I. Overview</a>
      <a href="#requirements">II. Business Requirements</a>
      <a href="#wireframes">III. Major Interface Wireframes</a>
      <a href="#user-manual">IV. User Manual</a>
    </nav>

    <section id="overview">
      <h2>I. Overview</h2>
      <p>
        The <strong>E-Track: Document Tracking System (DTS)</strong> is a web-based tool that helps organizations manage documents more efficiently.
        Instead of relying on paper files or scattered emails, DTS allows users to upload, send, track, and retrieve documents all in one secure online space.
        This makes it easier to stay organized and ensures important files don’t get lost or forgotten.
      </p>

      <p>
        One major problem with manual tracking is that documents can go missing or become stuck waiting for approval.
        E-Track solves this by keeping a detailed record of every action taken — who opened the file, what they did, and when they did it.
        This creates transparency and accountability.
      </p>

      <p>
        E-Track is particularly useful for government offices, schools, and private companies where many people handle sensitive documents.
        When timing and accuracy matter, DTS saves time, reduces stress, and improves productivity — helping teams work smarter, not harder.
      </p>
    </section>

    <section id="requirements">
      <h2>II. Business Requirements</h2>
      <p>Table 2.1 below summarizes the functional and non-functional requirements identified for the web-based system.</p>

      <table aria-label="Functional and Non-functional Requirements">
        <thead>
          <tr>
            <th>Functional Requirements</th>
            <th>Non-functional Requirements</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>The system must allow users to register and log in securely.</td>
            <td>The system shall load within 3 seconds for standard operations.</td>
          </tr>
          <tr>
            <td>Users must be able to upload new documents with metadata (title, reference number, description).</td>
            <td>User data and documents shall be stored securely with encryption.</td>
          </tr>
          <tr>
            <td>The system must allow authorized staff to update the status of documents (e.g., “Received,” “In Review,” “Approved,” “Released”).</td>
            <td>The interface shall be simple, intuitive, and responsive on multiple devices.</td>
          </tr>
          <tr>
            <td>The system must generate tracking codes for uploaded documents.</td>
            <td>The system shall allow role-based access control (e.g., Admin, Clerk, User).</td>
          </tr>
          <tr>
            <td>Users must be able to search and filter documents by keywords, status, or date.</td>
            <td>The system shall support up to [???] concurrent users without performance degradation.</td>
          </tr>
          <tr>
            <td>The system must provide audit logs for every transaction.</td>
            <td>The system shall ensure minimal data loss by implementing backup and recovery features.</td>
          </tr>
          <tr>
            <td>Reports must be generated showing document flow, pending documents, and turnaround times.</td>
            <td>The system shall load within 3 seconds for standard operations.</td>
          </tr>
          <tr>
            <td>The system must allow users to register and log in securely.</td>
            <td>User data and documents shall be stored securely with encryption.</td>
          </tr>
        </tbody>
      </table>
    </section>

    <section id="wireframes" class="wireframes">
      <h2>III. Major Interface Wireframes</h2>
      <p>Below are the main pages and placeholders for screenshots/wireframes. Replace the placeholders with actual screenshots before finalizing the documentation:</p>

      <h3>User Area Pages</h3>
      <div>
        <strong>Dashboard Page</strong>
        <div class="placeholder" role="img" aria-label="Dashboard wireframe placeholder">Figure 3.1: Dashboard Page (insert screenshot)</div>
      </div>

      <div style="margin-top:12px;">
        <strong>Upload Documents Page</strong>
        <div class="placeholder" role="img" aria-label="Upload Documents wireframe placeholder">Figure 3.2: Upload Documents Page (insert screenshot)</div>
      </div>

      <div style="margin-top:12px;">
        <strong>My Documents Page</strong>
        <div class="placeholder" role="img" aria-label="My Documents wireframe placeholder">Figure 3.3: My Documents Page (insert screenshot)</div>
      </div>

      <div style="margin-top:12px;">
        <strong>Notifications Page</strong>
        <div class="placeholder" role="img" aria-label="Notifications wireframe placeholder">Figure 3.4: Notifications Page (insert screenshot)</div>
      </div>

      <div style="margin-top:12px;">
        <strong>Profile Page</strong>
        <div class="placeholder" role="img" aria-label="Profile wireframe placeholder">Figure 3.5: Profile Page (insert screenshot)</div>
      </div>

      <h3 style="margin-top:18px;">Admin Area</h3>
      <p class="muted">[insert admin screenshots and descriptions here]</p>
    </section>

    <section id="user-manual">
      <h2>IV. User Manual</h2>
      <p class="muted">[Insert step-by-step user manual content and screenshots here — typical sections below]</p>

      <ol>
        <li><strong>Register / Login</strong> — How to create an account, password rules, two-factor authentication (if applicable).</li>
        <li><strong>Upload Documents</strong> — Required metadata fields, accepted file types, size limits, and upload confirmation behavior.</li>
        <li><strong>Track Documents</strong> — How to view status, tracking codes, filtering and searching.</li>
        <li><strong>Update Status (Authorized Staff)</strong> — Steps for clerks and admins to change document statuses and add notes.</li>
        <li><strong>Notifications</strong> — When and how users receive email or in-app notifications.</li>
        <li><strong>Reports</strong> — Generating document flow, pending items, and turnaround time reports.</li>
        <li><strong>Profile & Settings</strong> — Edit profile, change password, and adjust notification preferences.</li>
      </ol>

      <p>Include screenshots beside each step for clarity. If the application supports role-based UI differences, add a short section describing what Admins, Clerks, and Users can see and do.</p>
    </section>

    <footer>
      <div>Converted from <code>BASE_Template.docx</code>. :contentReference[oaicite:1]{index=1}</div>
      <div style="margin-top:8px;">How to use: save this file as <code>README.html</code> and open in any browser. Replace wireframe placeholders with real screenshots and expand the User Manual steps with real screenshots and exact instructions.</div>
    </footer>
  </div>
</body>
</html>
