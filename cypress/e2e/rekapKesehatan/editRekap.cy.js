// describe("Mengedit data rekap kesehatan dengan semua data valid", () => {
//     it("Berhasil memperbarui data rekap kesehatan", () => {
//         cy.visit("http://localhost:8000/healthfarm/7/edit");
//         cy.get("form").within(() => {
//             cy.get('#yourUsername').type('admin');
//             cy.get('#yourPassword').type('admin');
//             cy.contains('Masuk').click();
//             cy.get('#farm_id').select('107');
//             cy.get('#tanggal').clear().type('2022-12-11');
//             cy.get('#keterangan').clear().type('Flue Meriang');
//             cy.get('#drug_id').select('Pitazole');
//             cy.get('#jumlah').clear().type('1');
//             cy.get('#submit').click();
//         });
//     });
// });

// describe("Mengedit data rekap kesehatan dengan nomor sapi tidak valid", () => {
//     it("Gagal memperbarui data rekap kesehatan", () => {
//         cy.visit("http://localhost:8000/healthfarm/7/edit");
//         cy.get("form").within(() => {
//             cy.get('#yourUsername').type('admin');
//             cy.get('#yourPassword').type('admin');
//             cy.contains('Masuk').click();
//             cy.get('#farm_id').select('-- Pilih Nomor Sapi --')
//             cy.get('#tanggal').clear().type('2022-12-11');
//             cy.get('#keterangan').clear().type('Flue');
//             cy.get('#drug_id').select('Pitazole');
//             cy.get('#jumlah').clear().type('1');
//             cy.get('#submit').click();
//         });
//     });
// });

// describe("Mengedit data rekap kesehatan dengan tanggal tidak valid", () => {
//     it("Gagal memperbarui data rekap kesehatan", () => {
//         cy.visit("http://localhost:8000/healthfarm/7/edit");
//         cy.get("form").within(() => {
//             cy.get('#yourUsername').type('admin');
//             cy.get('#yourPassword').type('admin');
//             cy.contains('Masuk').click();
//             cy.get('#farm_id').select('107');
//             cy.get('#tanggal').clear();
//             cy.get('#keterangan').clear().type('Flue');
//             cy.get('#drug_id').select('Pitazole');
//             cy.get('#jumlah').clear().type('1');
//             cy.get('#submit').click();
//         });
//     });
// });

// describe("Mengedit data rekap kesehatan dengan nama obat tidak valid", () => {
//     it("Gagal memperbarui data rekap kesehatan", () => {
//         cy.visit("http://localhost:8000/healthfarm/7/edit");
//         cy.get("form").within(() => {
//             cy.get('#yourUsername').type('admin');
//             cy.get('#yourPassword').type('admin');
//             cy.contains('Masuk').click();
//             cy.get('#farm_id').select('107');
//             cy.get('#tanggal').clear().type('2022-12-11');
//             cy.get('#keterangan').clear().type('Demam Meriang');
//             cy.get('#drug_id').select('-- Pilih Nama Obat --');
//             cy.get('#jumlah').clear().type('1');
//             cy.get('#submit').click();
//         });
//     });
// });

describe("Mengedit data rekap kesehatan dengan jumlah obat tidak valid", () => {
    it("Gagal memperbarui data rekap kesehatan", () => {
        cy.visit("http://localhost:8000/healthfarm/7/edit");
        cy.get("form").within(() => {
            cy.get('#yourUsername').type('admin');
            cy.get('#yourPassword').type('admin');
            cy.contains('Masuk').click();
            cy.get('#farm_id').select('107');
            cy.get('#tanggal').clear().type('2022-12-11');
            cy.get('#keterangan').clear().type('Demam Flue');
            cy.get('#drug_id').select('Pitazole');
            cy.get('#jumlah').clear();
            cy.get('#submit').click();
        });
    });
});


