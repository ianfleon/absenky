<tr>
    <td><?= $nama_staff; ?></td>
    <td><?= $posisi_staff; ?></td>
    <td>
        <a href="#" class="text-decoration-none" onclick="showQR('<?= $id_staff; ?>', '<?= $nama_staff; ?>')" data-bs-toggle="modal" data-bs-target="#modalqr">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" viewBox="0 0 256 256" id="qr-code">
                <rect width="256" height="256" fill="none"></rect>
                <rect width="60" height="60" x="48.002" y="48" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="24" rx="8"></rect>
                <rect width="60" height="60" x="48.002" y="148" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="24" rx="8"></rect>
                <rect width="60" height="60" x="148.002" y="48" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="24" rx="8"></rect>
                <line x1="148.002" x2="148.002" y1="148" y2="172" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="24"></line>
                <polyline fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="24" points="148.002 208 184.002 208 184.002 148"></polyline>
                <line x1="184.002" x2="208.002" y1="164" y2="164" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="24"></line>
            </svg>
        </a>
        <a href="izin.php?id=<?= $id_staff; ?>" class="text-decoration-none">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" viewBox="0 0 24 24" id="sick">
                <path d="M7.66,12.21a1,1,0,0,0,.71.29,1,1,0,0,0,.71-.29l1.5-1.5a1,1,0,0,0,0-1.42l-1.5-1.5A1,1,0,0,0,7.66,9.21l.8.79-.8.79A1,1,0,0,0,7.66,12.21Zm7.5,0a1,1,0,0,0,.71.29,1,1,0,0,0,.71-.29,1,1,0,0,0,0-1.42L15.79,10l.79-.79a1,1,0,1,0-1.42-1.42l-1.5,1.5a1,1,0,0,0,0,1.42Zm.11,2a1,1,0,0,0-1.2,0l-.74.55-.73-.55a1,1,0,0,0-1.2,0l-.73.55-.74-.55a1,1,0,0,0-1.2,0l-1.33,1a1,1,0,1,0,1.2,1.6l.73-.55.74.55,0,0a.67.67,0,0,0,.12.06.83.83,0,0,0,.22.08l.13,0h.23l.12,0a1.12,1.12,0,0,0,.33-.16l.73-.55.73.55a1,1,0,0,0,1,.11l.1-.05a.39.39,0,0,0,.11-.06l.74-.55.73.55a1,1,0,0,0,.6.2,1,1,0,0,0,.8-.4,1,1,0,0,0-.2-1.4ZM12,2A10,10,0,1,0,22,12,10,10,0,0,0,12,2Zm0,18a8,8,0,1,1,8-8A8,8,0,0,1,12,20Z">
                </path>
            </svg>
        </a>
        <a href="form-staff.php?idstaff=<?= $id_staff; ?>" class="text-decoration-none">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" viewBox="0 0 24 24" id="pen">
                <path d="M21,12a1,1,0,0,0-1,1v6a1,1,0,0,1-1,1H5a1,1,0,0,1-1-1V5A1,1,0,0,1,5,4h6a1,1,0,0,0,0-2H5A3,3,0,0,0,2,5V19a3,3,0,0,0,3,3H19a3,3,0,0,0,3-3V13A1,1,0,0,0,21,12ZM6,12.76V17a1,1,0,0,0,1,1h4.24a1,1,0,0,0,.71-.29l6.92-6.93h0L21.71,8a1,1,0,0,0,0-1.42L17.47,2.29a1,1,0,0,0-1.42,0L13.23,5.12h0L6.29,12.05A1,1,0,0,0,6,12.76ZM16.76,4.41l2.83,2.83L18.17,8.66,15.34,5.83ZM8,13.17l5.93-5.93,2.83,2.83L10.83,16H8Z">
                </path>
            </svg>
        </a>
        <a href="#" class="text-decoration-none" id="btn_hapus" onclick="deleteStaff('<?= $id_staff; ?>', '<?= $nama_staff; ?>', this)">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" viewBox="0 0 24 24" id="trash">
                <path d="M10,18a1,1,0,0,0,1-1V11a1,1,0,0,0-2,0v6A1,1,0,0,0,10,18ZM20,6H16V5a3,3,0,0,0-3-3H11A3,3,0,0,0,8,5V6H4A1,1,0,0,0,4,8H5V19a3,3,0,0,0,3,3h8a3,3,0,0,0,3-3V8h1a1,1,0,0,0,0-2ZM10,5a1,1,0,0,1,1-1h2a1,1,0,0,1,1,1V6H10Zm7,14a1,1,0,0,1-1,1H8a1,1,0,0,1-1-1V8H17Zm-3-1a1,1,0,0,0,1-1V11a1,1,0,0,0-2,0v6A1,1,0,0,0,14,18Z">
                </path>
            </svg>
        </a>
    </td>
</tr>