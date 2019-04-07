var token;

const axiosLogin = axios
    .get("/api/login", {
        params: {
            email: "candidato@eskive.tech",
            password: "123"
        }
    })
    .then(response => {
        token = response.data.data.token;
    });

// ---------------------------------- //
//                                    Utils                                 //
// ---------------------------------- //
function addClassToElement(c, e) {
    if (!e.classList.contains(c)) e.classList.add(c);
}

function formatCpf(cpf) {
    cpf = cpf
        .replace(/\D/g, "")
        .replace(/(\d{3})(\d)/, "$1.$2")
        .replace(/(\d{3})(\d)/, "$1.$2")
        .replace(/(\d{3})(\d{1,2})$/, "$1-$2");

    return cpf;
}

// ---------------------------------- //
//                                      CPF                                   //
// ---------------------------------- //
const userForm = document.getElementById("userForm");
const userFormBtn = document.getElementById("userFormBtn");
const cpf = document.getElementById("cpfInput");

if (cpf != undefined) {
    cpf.onkeypress = e => {
        cpf.value = formatCpf(cpf.value);

        if (cpf.value.length >= 13) {
            cpf.value = cpf.value.substring(0, 13);
        }
    };
}

if (userFormBtn != undefined) {
    userFormBtn.onclick = e => {
        e.preventDefault();

        let strCPF = cpf.value
            .replace(".", "")
            .replace(".", "")
            .replace("-", "");
        let sum;
        let remainder;
        sum = 0;
        if (strCPF == "00000000000") {
            addClassToElement("is-invalid", cpf);
            return false;
        }

        for (i = 1; i <= 9; i++)
            sum = sum + parseInt(strCPF.substring(i - 1, i)) * (11 - i);
        remainder = (sum * 10) % 11;

        if (remainder == 10 || remainder == 11) remainder = 0;
        if (remainder != parseInt(strCPF.substring(9, 10))) {
            addClassToElement("is-invalid", cpf);
            return false;
        }

        sum = 0;
        for (i = 1; i <= 10; i++)
            sum = sum + parseInt(strCPF.substring(i - 1, i)) * (12 - i);
        remainder = (sum * 10) % 11;

        if (remainder == 10 || remainder == 11) remainder = 0;
        if (remainder != parseInt(strCPF.substring(10, 11))) {
            addClassToElement("is-invalid", cpf);
            return false;
        }

        cpf.value = Number(strCPF);
        cpf.classList.remove("is-invalid");
        userForm.submit();
    };
}

// ---------------------------------- //
//                             Modal Users                           //
// ---------------------------------- //
const userModalEditBtn = document.getElementById("userViewModal-editBtn");
const userModalTitle = document.getElementById("userViewModal-title");
const userModalTableId = document.getElementById("userViewModal-table-id");
const userModalTableFirstName = document.getElementById(
    "userViewModal-table-first_name"
);
const userModalTableLastName = document.getElementById(
    "userViewModal-table-last_name"
);
const userModalTableEmail = document.getElementById(
    "userViewModal-table-email"
);
const userModalTableAddress = document.getElementById(
    "userViewModal-table-address"
);
const userModalTablePhone = document.getElementById(
    "userViewModal-table-phone"
);
const userModalTableSex = document.getElementById("userViewModal-table-sex");
const userModalTableCpf = document.getElementById("userViewModal-table-cpf");
const userModalTableCreatedAt = document.getElementById(
    "userViewModal-table-created_at"
);
const userModalTableUpdatedAt = document.getElementById(
    "userViewModal-table-updated_at"
);

async function setupModal(response) {
    if (response.sex === 0) {
        response.sex = "Masculino";
    } else if (response.sex === 1) {
        response.sex = "Feminino";
    } else {
        response.sex = "Outro";
    }

    userModalTitle.innerText = response.full_name;
    userModalTableId.innerHTML = response.id;
    userModalTableFirstName.innerHTML = response.first_name;
    userModalTableLastName.innerHTML = response.last_name;
    userModalTableEmail.innerHTML = response.email;
    userModalTableAddress.innerHTML = response.address;
    userModalTablePhone.innerHTML = response.phone;
    userModalTableSex.innerHTML = response.sex;
    userModalTableCpf.innerHTML = formatCpf(response.cpf);
    userModalTableCreatedAt.innerHTML = response.created_at;
    userModalTableUpdatedAt.innerHTML = response.updated_at;
    userModalEditBtn.href = "/users/" + response.id + "/edit";

    $("#userModal").modal("show");
}

async function showMore(user) {
    const query = axios.get("/api/users/" + user + "/show?token=" + token);
    query.then(async res => {
        let response = res.data.data;
        await setupModal(response);
    });
}

// ---------------------------------- //
//                             Data Tables                           //
// ---------------------------------- //
$(document).ready(() => {
    $("#dataTableUserList").DataTable({
        paging: false,
        pageLength: false,
        info: false,
        language: {
            search: "Pesquisar nesta tabela:"
        }
    });
});
