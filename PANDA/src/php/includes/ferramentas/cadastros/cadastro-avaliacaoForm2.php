<!-- <head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/virtual-select-plugin@1.0.16/dist/virtual-select.min.css" integrity="sha256-umM1c7RyV/yt71xjIgPErO3PYajUHRxxvWJn+YRWSWw=" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/virtual-select-plugin@1.0.16/dist/virtual-select.min.js" integrity="sha256-6PuvJQXKao5OMgfl/WZUzznOvrd0J3hZcaT0XpJRDO0=" crossorigin="anonymous"></script>
</head> -->

<form class="row col-12 m-0 needs-validation" id="avaliacaoForm2" novalidate>
    <div class="col-12">
        <div class="form-control">
            <?php
            if (isset($avaliacaoCriado) && !empty($avaliacaoCriado)) {
                $mensagem = $avaliacaoCriado["mensagem"];
                $id_avaliacao = $avaliacaoCriado["id_avaliacao"];
                $name_avaliacao = $avaliacaoCriado["name_avaliacao"];

                echo "<h3>Avaliacao Criado agora:</h3>";
                echo "<h5>Título: <strong>$name_avaliacao</strong></h5>";
                echo "<h5>Mensagem:</h5>";
                echo "<h10><strong>$mensagem</strong></h10>";
                echo "<input type='hidden' value='$id_avaliacao' name='id_avaliacao' id='id_avaliacao'>";
            } else {
                echo "<label for='id_avaliacao' class='form-label'>Avaliacao</label>";
                echo "<div id='id_avaliacao'></div>";
            }
            ?>
        </div>
    </div>

    <div class="col-6">
        <div class="form-control">
            <label for="id_turma" class="form-label">Turma</label>
            <div id="id_turma"></div>
        </div>
    </div>

    <div class="col-6">
        <div class="form-control">
            <label for="id_aluno" class="form-label">Aluno</label>
            <div id="id_aluno"></div>
        </div>
    </div>

    <div class="col-12">
        <button class="btn btn-primary w-100 mt-2 submitBtn" type="submit">
            <h5>criar</h5>
        </button>
    </div>
</form>

<div class="mt-2 text-center">
    <a class="btn btn-outline-secondary" onclick="backHistory()" style="text-decoration: none;">
        <span>Voltar</span>
    </a>
</div>

<script>
    /* *****CRIANDO LISTA DE AVALIACOES E DE DESTINOS***** */
    $(document).ready(() => {
        <?php
        if (isset($avaliacaoCriado)) {
            $tipo = $avaliacaoCriado["tipo"];
            echo "initVStarget($tipo);\n";
        } else {
            echo "initVStarget(0);\n";
            echo "initIdAvaliacao(allAvaliacoes);\n";
        }
        ?>
    });

    function initIdAvaliacao(allAvaliacoes) {
        VirtualSelect.init({
            ele: '#id_avaliacao',
            name: 'id_avaliacao',
            placeholder: 'selecione o avaliacao',
            options: [
                <?php
                if (!empty($allAvaliacoes)) {
                    foreach ($allAvaliacoes as $avaliacao) {
                        $value = intval($avaliacao['id_avaliacao']);
                        $label = $avaliacao['name_avaliacao'];

                        echo "{ label: '$label', value: $value },\n";
                    }
                }
                ?>
            ],
            search: true,
            required: true,
            keepAlwaysOpen: true,
        });

        if (!allAvaliacoes.length) {
            initVStarget(0);
            return false;
        }

        var selectAvaliacao = document.querySelector('#id_avaliacao');
        selectAvaliacao.addEventListener("change", (event) => {
            console.log("selectAvaliacao changed");
            var selectedAvaliacaoID = selectAvaliacao.value;
            for (const avaliacao of allAvaliacoes) {
                if (avaliacao.id_avaliacao == selectedAvaliacaoID) {
                    var selectedAvaliacao = avaliacao;
                    console.log(selectedAvaliacao.tipo);
                    initVStarget(selectedAvaliacao.tipo);
                    return true;
                }
            }
        });
    }

    function initVStarget(tipo) { //1-turma 2-individual
        console.log("initVStarget(" + tipo + ")");
        clearVS();

        let VSavaliacao = document.querySelector('#id_avaliacao');
        let VSturma = document.querySelector('#id_turma');
        let VSaluno = document.querySelector('#id_aluno');

        switch (tipo) {
            case '1':
                initVSturma();
                VSavaliacao.parentElement.parentElement.className = "col-6";
                VSturma.parentElement.parentElement.style.display = 'block';
                VSaluno.parentElement.parentElement.style.display = 'none';
                break;
            case '2':
                initVSaluno();
                VSavaliacao.parentElement.parentElement.className = "col-6";
                VSaluno.parentElement.parentElement.style.display = 'block';
                VSturma.parentElement.parentElement.style.display = 'none';
                break;

            default:
                console.log('default');
                VSavaliacao.parentElement.parentElement.className = "col-12";
                VSaluno.parentElement.parentElement.style.display = 'none';
                VSturma.parentElement.parentElement.style.display = 'none';
                break;
        }
    }

    function clearVS() {
        let popComps = [document.querySelector('#id_turma'), document.querySelector('#id_aluno')];
        for (const popComp of popComps) {
            if (popComp.classList.contains('vscomp-ele')) {
                popComp.destroy();
            };
        }
    }

    function initVSturma() {
        console.log('initVSturma()');
        VirtualSelect.init({
            ele: '#id_turma',
            name: 'id_turma',
            placeholder: 'selecione a turma',
            options: [
                <?php
                try {
                    if (!empty($allTurmas)) {
                        foreach ($allTurmas as $turma) {
                            $value = intval($turma['id_turma']);
                            $label = $turma['name_turma'];
                            echo "{ label: '$label', value: '$value' },\n";
                        }
                    } else {
                        echo "{ label: 'nenhuma turma encontrado', value: '' }\n";
                    }
                } catch (EXCEPTION $e) {
                    echo "console.error(" . $e->getMessage() . ")";
                }
                ?>
            ],
            multiple: true,
            keepAlwaysOpen: true,
            required: true,
        });

        inputs = document.getElementsByClassName('vscomp-hidden-input');
        for (const input of inputs) {
            input.classList.add('form-control');
        }
    }

    function initVSaluno() {
        console.log('initVSaluno()');
        VirtualSelect.init({
            ele: '#id_aluno',
            name: 'id_aluno',
            placeholder: 'selecione os alunos',
            options: [
                <?php
                if (!empty($allAlunos)) {
                    foreach ($allAlunos as $aluno) {
                        $value = intval($aluno['id_user']);
                        $label = $aluno['name'] . " " . $aluno['surname'];
                        echo "{ label: '$label', value: '$value' },\n";
                    }
                } else {
                    echo "{ label: 'nenhum aluno encontrado', value: '' }\n";
                }
                ?>
            ],
            multiple: true,
            keepAlwaysOpen: true,
            required: true,
        });

        inputs = document.getElementsByClassName('vscomp-hidden-input');
        for (const input of inputs) {
            input.classList.add('form-control');
        }
    }
</script>