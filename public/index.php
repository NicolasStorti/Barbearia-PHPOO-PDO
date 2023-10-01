<?php

require_once __DIR__ . '/../vendor/autoload.php';

$dbPath = __DIR__ . '/../banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");


use Senac\Projeto\Controllers\{AgendamentoController\DeleteAgendamentoController,
    AgendamentoController\EditAgendamentoController,
    AgendamentoController\EditFormAgendamentoController,
    AgendamentoController\NewAgendamentoController,
    AgradecimentoViewController,
    BarbeiroController\AdmBarbeiroController,
    BarbeiroController\DeleteUsuarioController,
    BarbeiroController\FormBarbeiroController,
    BarbeiroController\FormBarbeiroLoginController,
    BarbeiroController\LoginBarberController,
    BarbeiroController\LogoutBarbeiroController,
    BarbeiroController\NewBarbeiroController,
    BarbeiroController\SessionBarbeiro,
    BarbeiroController\UsuariosCadastradosController,
    Controller,
    EmailController,
    Error404Controller,
    HomeViewController,
    ServicoController\DeleteServicoController,
    ServicoController\EditServicoController,
    ServicoController\EditServicoFormController,
    ServicoController\FormServicoController,
    ServicoController\ListServicoController,
    ServicoController\NewServicoController,
    UsuariosController\DashboardViewController,
    UsuariosController\EditPerfilController,
    UsuariosController\EditPerfilForm,
    UsuariosController\FormLoginUsuarioController,
    UsuariosController\FormUsuarioController,
    UsuariosController\LoginUsuarioController,
    UsuariosController\LogoutUsuarioController,
    UsuariosController\NewUsuarioController,
    UsuariosController\SessionUsuarioController,
    UsuariosController\VerUsuarioController};
use Senac\Projeto\Repository\{AgendamentoRepository,
    UsuarioRepository,
    BarbeiroRepository,
    ServicoRepository
};
//não consegui configurar no modelo routes
//$routes = require_once __DIR__ . '/../config/routes.php';

$usuarioRepository = new UsuarioRepository($pdo);
$barbeiroRepository = new BarbeiroRepository($pdo);
$servicoRepository = new ServicoRepository($pdo);
$agendamentoRepository = new AgendamentoRepository($pdo);

if (!array_key_exists('PATH_INFO', $_SERVER) || $_SERVER['PATH_INFO'] === '/') {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $controller = new HomeViewController();
    }elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $controller = new EmailController();
    }
}elseif ($_SERVER['PATH_INFO'] === '/login') {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $controller = new FormLoginUsuarioController();
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $sessionUsuarioController = new SessionUsuarioController();
        $controller = new LoginUsuarioController($usuarioRepository, $sessionUsuarioController);
    }
} elseif ($_SERVER['PATH_INFO'] === '/cadastro-usuario') {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $controller = new FormUsuarioController($usuarioRepository);
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $controller = new NewUsuarioController($usuarioRepository);
    }
} elseif ($_SERVER['PATH_INFO'] === '/login-barbeiro') {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $controller = new FormBarbeiroLoginController();
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $sessionBarbeiro = new SessionBarbeiro();
        $controller = new LoginBarberController($barbeiroRepository, $sessionBarbeiro);
    }
} elseif ($_SERVER['PATH_INFO'] === '/cadastro-barbeiro') {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $controller = new FormBarbeiroController($barbeiroRepository);
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $sessionBarbeiro = new SessionBarbeiro();
        $controller = new NewBarbeiroController($barbeiroRepository);
    }
} elseif ($_SERVER['PATH_INFO'] === '/logout') {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $sessionUsuarioController = new SessionUsuarioController();
        $controller = new LogoutUsuarioController($usuarioRepository, $sessionUsuarioController);
    }
} elseif ($_SERVER['PATH_INFO'] === '/sair-barbeiro') {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $sessionBarbeiro = new SessionBarbeiro();
        $controller = new LogoutBarbeiroController($barbeiroRepository, $sessionBarbeiro);
    }
} elseif ($_SERVER['PATH_INFO'] === '/dashboard') {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $sessionUsuarioController = new SessionUsuarioController();
        $controller = new DashboardViewController($usuarioRepository, $sessionUsuarioController, $barbeiroRepository);
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $sessionUsuarioController = new SessionUsuarioController();
        $controller = new NewAgendamentoController($agendamentoRepository, $sessionUsuarioController);
    }
} elseif ($_SERVER['PATH_INFO'] === '/administracao') {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $sessionBarbeiro = new SessionBarbeiro();
        $controller = new AdmBarbeiroController($barbeiroRepository, $sessionBarbeiro,$agendamentoRepository,$usuarioRepository,$servicoRepository);
    }
} elseif ($_SERVER['PATH_INFO'] === '/cadastro-servico') {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $sessionBarbeiro = new SessionBarbeiro();
        $controller = new FormServicoController($servicoRepository, $barbeiroRepository, $sessionBarbeiro);
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $sessionBarbeiro = new SessionBarbeiro();
        $controller = new NewServicoController($servicoRepository, $sessionBarbeiro);
    }
}elseif ($_SERVER['PATH_INFO'] === '/ver-usuario'){
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $sessionUsuarioController = new SessionUsuarioController();
        $controller = new VerUsuarioController($usuarioRepository,$sessionUsuarioController);
    }
}elseif ($_SERVER['PATH_INFO'] === '/editar-usuario') {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $sessionUsuarioController = new SessionUsuarioController();
        $controller = new EditPerfilForm($usuarioRepository,$sessionUsuarioController);
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $sessionUsuarioController = new SessionUsuarioController();
        $controller = new EditPerfilController($usuarioRepository,$sessionUsuarioController);
    }
}elseif ($_SERVER['PATH_INFO'] === '/usuarios-cadastrados') {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $sessionBarbeiro = new SessionBarbeiro();
        $controller = new UsuariosCadastradosController($usuarioRepository,$barbeiroRepository,$sessionBarbeiro);
    }
}elseif ($_SERVER['PATH_INFO'] === '/excluir-usuario') {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $sessionBarbeiro = new SessionBarbeiro();
        $controller = new DeleteUsuarioController($usuarioRepository,$sessionBarbeiro);
    }
}elseif ($_SERVER['PATH_INFO'] === '/excluir-agendamento') {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $sessionBarbeiro = new SessionBarbeiro();
        $controller = new DeleteAgendamentoController($sessionBarbeiro,$agendamentoRepository);
    }
}elseif ($_SERVER['PATH_INFO'] === '/edit-agendamento') {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $sessionBarbeiro = new SessionBarbeiro();
        $controller = new EditFormAgendamentoController($agendamentoRepository,$sessionBarbeiro);
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $sessionBarbeiro = new SessionBarbeiro();
        $controller = new EditAgendamentoController($agendamentoRepository,$sessionBarbeiro,$usuarioRepository);
    }
}elseif ($_SERVER['PATH_INFO'] === '/servicos') {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $sessionBarbeiro = new SessionBarbeiro();
        $controller = new ListServicoController($servicoRepository,$barbeiroRepository,$sessionBarbeiro);
    }
}elseif ($_SERVER['PATH_INFO'] === '/delete-servico') {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $sessionBarbeiro = new SessionBarbeiro();
        $controller = new DeleteServicoController($servicoRepository,$barbeiroRepository,$sessionBarbeiro);
    }
}elseif ($_SERVER['PATH_INFO'] === '/edit-servico') {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $sessionBarbeiro = new SessionBarbeiro();
        $controller = new EditServicoFormController($servicoRepository,$barbeiroRepository,$sessionBarbeiro);
    }elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $sessionBarbeiro = new SessionBarbeiro();
        $controller = new EditServicoController($servicoRepository,$sessionBarbeiro);
    }
}elseif ($_SERVER['PATH_INFO'] === '/agradecimento') {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $controller = new AgradecimentoViewController();
    }
}
else {
    $controller = new Error404Controller();
}

/** @var Controller $controller */

$controller->processaRequisicao();








