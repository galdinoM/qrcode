import { useState, useEffect, useRef, SetStateAction } from "react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head } from "@inertiajs/react";
import { PageProps } from "@/types";
import TableComponent from "@/Components/Table";

export default function Dashboard({ auth }: PageProps) {
    const [tableData, setTableData] = useState([]);
    const [file, setFile] = useState<File | null>(null);
    const fileInputRef = useRef<HTMLInputElement | null>(null);

    useEffect(() => {
        const xsrfToken = document.cookie
            .split(";")
            .find((cookie) => cookie.trim().startsWith("XSRF-TOKEN="));

        if (!xsrfToken) {
            console.error("Nenhum token XSRF encontrado.");
            return;
        }

        const token = xsrfToken.split("=")[1];

        fetch("/data", {
            headers: {
                Authorization: `Bearer ${token}`,
            },
        })
            .then((response) => {
                if (!response.ok) {
                    throw new Error("Erro ao buscar dados.");
                }
                return response.json();
            })
            .then((data) => {
                setTableData(data);
            })
            .catch((error) => {
                console.error("Erro ao buscar dados:", error);
            });
    }, []);

    const handleViewDetails = (item: any) => {
        console.log("Detalhes do item:", item);
    };

    const handleImportClick = () => {
        if (fileInputRef.current instanceof HTMLInputElement) {
            fileInputRef.current.click();
        }
    };

    const handleFileChange = (event: React.ChangeEvent<HTMLInputElement>) => {
        const selectedFile = event.target.files?.[0];
        if (selectedFile !== undefined) {
            setFile(selectedFile);
        }
    };

    const handleSubmit = (event: React.FormEvent<HTMLFormElement>) => {
        event.preventDefault();

        const xsrfToken = document.cookie
            .split(";")
            .find((cookie) => cookie.trim().startsWith("XSRF-TOKEN="));

        if (!xsrfToken) {
            console.error("Nenhum token XSRF encontrado.");
            return;
        }

        const fileInput = document.getElementById(
            "fileInput"
        ) as HTMLInputElement;
        const file = fileInput?.files?.[0];

        if (!file) {
            console.error("Nenhum arquivo selecionado.");
            return;
        }

        const formData = new FormData();
        formData.append("fileFederal", file);

        const metaTag = document.querySelector('meta[name="csrf-token"]');
        if (!metaTag) {
            console.error("Meta tag CSRF não encontrada.");
            return;
        }
        const csrfToken = metaTag.getAttribute("content");
        if (!csrfToken) {
            console.error("Token CSRF não encontrado.");
            return;
        }

        fetch("/upload", {
            method: "POST",
            body: formData,
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
        })
            .then((response) => response.json())
            .then((data) => {
                console.log("Resposta do servidor:", data);
            })
            .catch((error) => console.error("Erro ao fazer upload:", error));
    };

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <div className="flex justify-between items-center">
                    <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                        Dashboard
                    </h2>
                </div>
            }
        >
            <Head title="Dashboard" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900">
                            <form
                                onSubmit={handleSubmit}
                                encType="multipart/form-data"
                            >
                                <input
                                    ref={fileInputRef}
                                    type="file"
                                    id="fileInput"
                                    name="fileFederal"
                                    onChange={handleFileChange}
                                    style={{ display: "none" }}
                                />
                                <button
                                    type="button"
                                    onClick={handleImportClick}
                                    className="bg-green-500 text-white px-4 py-2 rounded-md mr-2"
                                >
                                    Importar arquivo
                                </button>
                                <button
                                    type="submit"
                                    className="bg-blue-500 text-white px-4 py-2 rounded-md"
                                >
                                    Enviar
                                </button>
                            </form>
                            <h1 className="text-3xl font-bold text-center my-8">
                                Tabela de Dados
                            </h1>
                            <TableComponent
                                data={tableData}
                                onViewDetails={handleViewDetails}
                            />
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
