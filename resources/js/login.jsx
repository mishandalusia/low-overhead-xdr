import { createRoot } from 'react-dom/client';
import LoginForm from './components/LoginForm';

const root = document.getElementById('login-root');

if (root) {
    createRoot(root).render(
        <LoginForm
            loginUrl={root.dataset.loginUrl}
            csrfToken={root.dataset.csrfToken}
            errorMessage={root.dataset.error || null}
            oldEmail={root.dataset.oldEmail || ''}
        />
    );
}
