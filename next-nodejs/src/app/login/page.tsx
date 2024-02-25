"use client";

import { Button } from "@/components/ui/buttons";
import { Input } from "@/components/ui/inputs";
import { useAuth } from "@/stores/auth";
import { setCookie } from "cookies-next";
import { useSearchParams } from "next/navigation";
import { useRouter } from "next/navigation";
import { useCallback, useEffect, useMemo, useState } from "react";

const LoginForm = ({ handleSwitch, setError }: any) => {
  const [emailOrPhone, setEmailOrPhone] = useState<string>("");
  const [password, setPassword] = useState<string>("");

  const logUserIn = useAuth((state: any) => state.logUserIn);

  const router = useRouter();

  const login = useCallback(() => {
    setError("");

    fetch(`${process.env.NEXT_PUBLIC_API_URL}/login`, {
      method: "post",
      headers: {
        Accept: "application/json",
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        email_or_phone: emailOrPhone,
        password: password,
      }),
    })
      .then((res) => res.json())
      .then((body) => {
        if (body.code !== 200) {
          setError(body.message);
        } else {
          setCookie("token", body.data.token);

          const user = body.data;

          delete user.token;

          logUserIn(user);

          if (user.role === "user") {
            window.location.href = "/";
          } else if (user.role === "admin") {
            window.location.href = "/admin";
          }
        }
      })
      .catch((e) => {
        setError(e.message);
      });
  }, [emailOrPhone, password, logUserIn, setError]);

  return (
    <div className="w-full">
      <div className="w-full mb-8">
        <h3 className="text-lg">Email/Nomor Telepon</h3>
        <Input
          value={emailOrPhone}
          placeholder="Contoh: admin@gmail.com"
          inputClassName="w-full"
          onChange={(event: any) => setEmailOrPhone(event.target.value)}
        />
      </div>

      <div className="w-full">
        <h3 className="text-lg">Password</h3>
        <Input
          value={password}
          type="password"
          placeholder="Masukan password"
          onChange={(event: any) => setPassword(event.target.value)}
        />
      </div>

      <div className="mt-8">
        <div className="mb-2">
          <Button label="Masuk" className="w-full" onClick={login} />
        </div>

        <div>
          <Button
            label="Daftar"
            color="primary-inverse"
            className="w-full"
            onClick={handleSwitch}
          />
        </div>
      </div>
    </div>
  );
};

const RegisterForm = ({ handleSwitch, setError, setSuccess }: any) => {
  const [name, setName] = useState<string>("");
  const [email, setEmail] = useState<string>("");
  const [phone, setPhone] = useState<string>("");

  const register = useCallback(() => {
    setError("");
    setSuccess("");

    fetch(`${process.env.NEXT_PUBLIC_API_URL}/register`, {
      method: "post",
      headers: {
        Accept: "application/json",
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        full_name: name,
        email: email,
        phone_number: phone,
      }),
    })
      .then((res) => res.json())
      .then((body) => {
        if (body.code !== 200) {
          setError(body.message);
        } else {
          setSuccess(body.message);
        }
      })
      .catch((e) => {
        setError(e.message);
      });
  }, [name, phone, email, setError, setSuccess]);

  return (
    <div className="w-full">
      <div className="w-full mb-8">
        <h3 className="text-lg">Nama</h3>
        <Input
          value={name}
          placeholder="Contoh: Agus"
          inputClassName="w-full"
          onChange={(event: any) => setName(event?.target.value)}
        />
      </div>

      <div className="w-full mb-8">
        <h3 className="text-lg">Email</h3>
        <Input
          value={email}
          placeholder="Contoh: admin@gmail.com"
          inputClassName="w-full"
          onChange={(event: any) => setEmail(event?.target.value)}
        />
      </div>

      <div className="w-full mb-8">
        <h3 className="text-lg">Nomor Telepon</h3>
        <Input
          value={phone}
          placeholder="Contoh: 656567456746"
          inputClassName="w-full"
          onChange={(event: any) => setPhone(event?.target.value)}
        />
      </div>

      <div className="mt-8">
        <div className="mb-2">
          <Button label="Daftar" className="w-full" onClick={register} />
        </div>

        <div>
          <Button
            label="Masuk"
            color="primary-inverse"
            className="w-full"
            onClick={handleSwitch}
          />
        </div>
      </div>
    </div>
  );
};

export default function Login() {
  const [isLoginForm, setIsLoginForm] = useState<boolean>(true);
  const [errorMessage, setErrorMessage] = useState<string>("");
  const [successMessage, setSuccessMessage] = useState<string>("");

  const user = useAuth((state: any) => state.user);

  const params = useSearchParams();
  const router = useRouter();

  const isRegisterParam = useMemo(() => {
    return params.get("register") === "true";
  }, [params]);

  useEffect(() => {
    if (user) {
      router.push("/");
    }
  }, [user, router]);

  useEffect(() => {
    setIsLoginForm(!isRegisterParam);
  }, [isRegisterParam]);

  useEffect(() => {
    setErrorMessage("");
    setSuccessMessage("");
  }, [isLoginForm]);

  return (
    <div className="flex h-screen">
      <div className="w-1/2 flex-shrink-0 h-full bg-primary-400 flex flex-col justify-center items-center">
        <h1 className="text-3xl mb- font-bold">Nama Aplikasi</h1>
        <div className="w-1/2 text-lg">
          Lorem Ipsum is simply dummy text of the printing and typesetting
          industry. Lorem Ipsum has been the industry&apos;s standard dummy text ever
          since the 1500s, when an unknown printer took a galley of type and
          scrambled it to make a type specimen book.
        </div>
      </div>

      <div className="w-1/2 flex-shrink-0 h-full flex flex-col justify-center items-center">
        <div className="w-full px-48">
          {errorMessage && (
            <div className="bg-red-400 text-white p-6 mb-8">{errorMessage}</div>
          )}

          {successMessage && (
            <div className="bg-green-400 text-white p-6 mb-8">
              {successMessage}
            </div>
          )}

          {isLoginForm && (
            <div>
              <div className="mb-4">
                <h2 className="text-xl font-bold mb-2">Selamat Datang</h2>

                <div>
                  Silahkan masukkan email atau nomor telepon dan password Anda
                  untuk mulai menggunakan aplikasi
                </div>
              </div>

              <LoginForm
                handleSwitch={() => setIsLoginForm(false)}
                setError={setErrorMessage}
              />
            </div>
          )}

          {!isLoginForm && (
            <div>
              <div className="mb-4">
                <h2 className="text-xl font-bold mb-2">Daftarkan Diri Anda</h2>

                <div>
                  Silahkan masukkan email atau nomor telepon dan password Anda
                  untuk mulai menggunakan aplikasi
                </div>
              </div>

              <RegisterForm
                handleSwitch={() => setIsLoginForm(true)}
                setError={setErrorMessage}
                setSuccess={setSuccessMessage}
              />
            </div>
          )}
        </div>
      </div>
    </div>
  );
}
