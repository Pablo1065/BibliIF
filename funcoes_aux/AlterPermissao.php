<label class="label-input" for="permissao">Permissão:
    <select name="permissao">
        <option value="leitor" <?php if ($u->get_permissao() == "leitor") {
                                    echo ("selected");
                                } ?>>Leitor</option>
        <option value="moderador" <?php if ($u->get_permissao() == "moderador") {
                                        echo ("selected");
                                    } ?>>Moderador</option>
        <option value="funcionario" <?php if ($u->get_permissao() == "funcionario") {
                                        echo ("selected");
                                    } ?>>Funcionario</option>
        <option value="adm" <?php if ($u->get_permissao() == "adm") {
                                echo ("selected");
                            } ?>>Administração</option>
    </select>
</label>