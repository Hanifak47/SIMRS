import { useEffect } from "react";
import { useNavigate } from "react-router-dom";
import { useAuth } from "../hooks/useAuth";
import { ProtectedRouteProps } from "../types/types";

const ProtectedRoute = ({ children, roles }: ProtectedRouteProps) => {
  const { user, loading } = useAuth();
  const navigate = useNavigate();

  useEffect(() => {
    if (loading) return;

    // jika belum login → arahkan ke halaman login
    if (!user) {
      navigate("/", { replace: true });
      return;
    }

    // jika role tidak sesuai → arahkan ke halaman unauthorized
    if (
      roles &&
      !user.roles?.some((role) =>
        typeof role === "string"
          ? roles.includes(role)
          : roles.includes(role.name)
      )
    ) {
      navigate("/unauthorized", { replace: true });
      return;
    }
  }, [user, roles, loading, navigate]);

  // selama loading atau user belum siap → jangan render apapun
  if (
    loading ||
    !user ||
    (roles &&
      !user.roles?.some((role) =>
        typeof role === "string"
          ? roles.includes(role)
          : roles.includes(role.name)
      ))
  ) {
    return null;
  }

  return children;
};

export default ProtectedRoute;
