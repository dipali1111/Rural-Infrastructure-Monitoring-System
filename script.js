document.addEventListener("DOMContentLoaded", () => {
    lucide.createIcons();
    loadProjects();
});

let currentWorkId = '';

// Load Projects from PHP / MySQL
async function loadProjects() {
    try {
        const response = await fetch('get_projects.php');
        const projects = await response.json();

        const tableBody = document.getElementById('workTableBody');
        tableBody.innerHTML = '';

        if(projects.length === 0) {
            tableBody.innerHTML = '<tr><td colspan="6" class="p-4 text-center">No projects found.</td></tr>';
            return;
        }

        projects.forEach(project => {
            const row = `
                <tr class="hover:bg-gray-50">
                    <td class="p-3 font-semibold text-[#133336]">
                        ${project.work_id}
                        <div class="font-normal text-gray-500">${project.work_name}</div>
                    </td>
                    <td class="p-3">${project.taluka} /${project.village}</td>
                    <td class="p-3"><span class="px-2 py-0.5 text-[10px] font-bold rounded bg-teal-50 text-[#285F6B]">${project.work_type}</span></td>
                    <td class="p-3 font-medium text-amber-700">${project.claimed_stage}</td>
                    <td class="p-3 font-semibold text-[#285F6B]">${project.status}</td>
                    <td class="p-3 text-center">
                        <button onclick="openModal('${project.work_id}', '${project.work_name}')" class="bg-[#285F6B] hover:bg-[#133336] text-white px-3 py-1 rounded text-[11px] font-medium">
                            Verify & Inspect
                        </button>
                    </td>
                </tr>
            `;
            tableBody.innerHTML += row;
        });

    } catch (error) {
        console.error('Error loading projects:', error);
    }
}

function openModal(workId, workName) {
    currentWorkId = workId;
    document.getElementById('modalWorkId').innerText = 'Verification for: ' + workId;
    document.getElementById('modalWorkName').innerText = workName;
    document.getElementById('verificationModal').classList.remove('hidden');
    document.getElementById('verificationModal').classList.add('flex');
}

function closeModal() {
    document.getElementById('verificationModal').classList.add('hidden');
    document.getElementById('verificationModal').classList.remove('flex');
}

git pull origin main
async function submitVerification() {
    const decision = document.querySelector('input[name="decision"]:checked').value;
    const remarks = document.getElementById('engineerRemarks').value;

    const payload = {
        work_id: currentWorkId,
        decision: decision,
        remarks: remarks
    };

    try {
        const response = await fetch('verify_work.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload)
        });

        const result = await response.json();
        
        if (result.status === 'success') {
            alert(result.message);
            closeModal();
            loadProjects(); // Refresh table with updated status from database
        } else {
            alert('Error: ' + result.message);
        }
    } catch (error) {
        console.error('Error submitting verification:', error);
        alert('Failed to connect to backend server.');
    }
}