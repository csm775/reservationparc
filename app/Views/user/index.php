<h1 class="text-2xl font-bold mb-4">Liste des utilisateurs</h1>

<table class="w-full border">
    <thead class="bg-gray-200">
        <tr>
            <th class="border p-2">ID</th>
            <th class="border p-2">Prénom</th>
            <th class="border p-2">Nom</th>
            <th class="border p-2">Email</th>
            <th class="border p-2">Rôle</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $u): ?>
            <tr>
                <td class="border p-2"><?= $u['id'] ?></td>
                <td class="border p-2"><?= $u['prenom'] ?></td>
                <td class="border p-2"><?= $u['nom'] ?></td>
                <td class="border p-2"><?= $u['email'] ?></td>
                <td class="border p-2"><?= $u['role'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
