CREATE DATABASE bdd_proyecto
GO

use bdd_proyecto
GO

-- CreateTable
CREATE TABLE [dbo].[TipoEvento] (
    [id_tipoEvento] NVARCHAR(1000) NOT NULL,
    [nombre] NVARCHAR(1000) NOT NULL,
    [tipoAsistencia] NVARCHAR(1000) NOT NULL,
    CONSTRAINT [TipoEvento_pkey] PRIMARY KEY CLUSTERED ([id_tipoEvento])
);

-- CreateTable
CREATE TABLE [dbo].[Evento] (
    [id_evento] NVARCHAR(1000) NOT NULL,
    [nombre] NVARCHAR(1000) NOT NULL,
    [descripcion] NVARCHAR(1000) NOT NULL,
    [id_tipoEvento] NVARCHAR(1000) NOT NULL,
    CONSTRAINT [Evento_pkey] PRIMARY KEY CLUSTERED ([id_evento])
);

-- CreateTable
CREATE TABLE [dbo].[ConvocatoriaGeneral] (
    [id_convocatoriaGeneral] NVARCHAR(1000) NOT NULL,
    [lugar] NVARCHAR(1000) NOT NULL,
    [fecha] DATETIME2 NOT NULL,
    [id_evento] NVARCHAR(1000) NOT NULL,
    [id_nivelAcademico] NVARCHAR(1000) NOT NULL,
    CONSTRAINT [ConvocatoriaGeneral_pkey] PRIMARY KEY CLUSTERED ([id_convocatoriaGeneral])
);

-- CreateTable
CREATE TABLE [dbo].[ConvocatoriaEspecifica] (
    [id_convocatoriaEspecifica] NVARCHAR(1000) NOT NULL,
    [lugar] NVARCHAR(1000) NOT NULL,
    [fecha] DATETIME2 NOT NULL,
    [id_evento] NVARCHAR(1000) NOT NULL,
    [id_aula] NVARCHAR(1000) NOT NULL,
    CONSTRAINT [ConvocatoriaEspecifica_pkey] PRIMARY KEY CLUSTERED ([id_convocatoriaEspecifica])
);

-- CreateTable
CREATE TABLE [dbo].[NivelAcademico] (
    [id_nivelAcademico] NVARCHAR(1000) NOT NULL,
    [nombre] NVARCHAR(1000) NOT NULL,
    CONSTRAINT [NivelAcademico_pkey] PRIMARY KEY CLUSTERED ([id_nivelAcademico])
);

-- CreateTable
CREATE TABLE [dbo].[Grado] (
    [id_grado] NVARCHAR(1000) NOT NULL,
    [nombre] NVARCHAR(1000) NOT NULL,
    [id_nivelAcademico] NVARCHAR(1000) NOT NULL,
    CONSTRAINT [Grado_pkey] PRIMARY KEY CLUSTERED ([id_grado])
);

-- CreateTable
CREATE TABLE [dbo].[Aula] (
    [id_aula] NVARCHAR(1000) NOT NULL,
    [seccion] NVARCHAR(1000) NOT NULL,
    [id_grado] NVARCHAR(1000) NOT NULL,
    CONSTRAINT [Aula_pkey] PRIMARY KEY CLUSTERED ([id_aula])
);

-- CreateTable
CREATE TABLE [dbo].[Usuario] (
    [id_usuario] NVARCHAR(1000) NOT NULL,
    [nombre] NVARCHAR(1000) NOT NULL,
    [apellido] NVARCHAR(1000) NOT NULL,
    [email] NVARCHAR(1000) NOT NULL,
    [password] NVARCHAR(1000) NOT NULL,
    [fecha_creacion] DATETIME2 NOT NULL CONSTRAINT [Usuario_fecha_creacion_df] DEFAULT CURRENT_TIMESTAMP,
    [activo] BIT NOT NULL CONSTRAINT [Usuario_activo_df] DEFAULT 1,
    [rol] NVARCHAR(1000) NOT NULL,
    CONSTRAINT [Usuario_pkey] PRIMARY KEY CLUSTERED ([id_usuario])
);

-- CreateTable
CREATE TABLE [dbo].[PadreFamilia] (
    [id_padreFamilia] NVARCHAR(1000) NOT NULL,
    [dui] NVARCHAR(1000) NOT NULL,
    [nombre] NVARCHAR(1000) NOT NULL,
    [apellidos] NVARCHAR(1000) NOT NULL,
    CONSTRAINT [PadreFamilia_pkey] PRIMARY KEY CLUSTERED ([id_padreFamilia]),
    CONSTRAINT [PadreFamilia_dui_key] UNIQUE NONCLUSTERED ([dui])
);

-- CreateTable
CREATE TABLE [dbo].[UsuarioPadresFamilia] (
    [id_usuarioPadreFamilia] NVARCHAR(1000) NOT NULL,
    [id_usuario] NVARCHAR(1000) NOT NULL,
    [id_padreFamilia] NVARCHAR(1000) NOT NULL,
    CONSTRAINT [UsuarioPadresFamilia_pkey] PRIMARY KEY CLUSTERED ([id_usuarioPadreFamilia])
);

-- CreateTable
CREATE TABLE [dbo].[UsuarioAula] (
    [id_usuarioaula] NVARCHAR(1000) NOT NULL,
    [id_usuario] NVARCHAR(1000) NOT NULL,
    [id_aula] NVARCHAR(1000) NOT NULL,
    CONSTRAINT [UsuarioAula_pkey] PRIMARY KEY CLUSTERED ([id_usuarioaula])
);

-- CreateTable
CREATE TABLE [dbo].[AsistenciaConvocatoriaEspecifica] (
    [id_asistenciaConvocatoriaEspecifica] NVARCHAR(1000) NOT NULL,
    [estado] NVARCHAR(1000) NOT NULL,
    [fecha_asistencia] DATETIME2 NOT NULL CONSTRAINT [AsistenciaConvocatoriaEspecifica_fecha_asistencia_df] DEFAULT CURRENT_TIMESTAMP,
    [id_usuario] NVARCHAR(1000) NOT NULL,
    [id_convocatoriaEspecifica] NVARCHAR(1000) NOT NULL,
    CONSTRAINT [AsistenciaConvocatoriaEspecifica_pkey] PRIMARY KEY CLUSTERED ([id_asistenciaConvocatoriaEspecifica])
);

-- CreateTable
CREATE TABLE [dbo].[AsistenciaConvocatoriaGeneral] (
    [id_asistenciaConvocatoriaGeneral] NVARCHAR(1000) NOT NULL,
    [estado] NVARCHAR(1000) NOT NULL,
    [fecha_asistencia] DATETIME2 NOT NULL CONSTRAINT [AsistenciaConvocatoriaGeneral_fecha_asistencia_df] DEFAULT CURRENT_TIMESTAMP,
    [id_usuario] NVARCHAR(1000) NOT NULL,
    [id_convocatoriaGeneral] NVARCHAR(1000) NOT NULL,
    CONSTRAINT [AsistenciaConvocatoriaGeneral_pkey] PRIMARY KEY CLUSTERED ([id_asistenciaConvocatoriaGeneral])
);

-- AddForeignKey
ALTER TABLE [dbo].[Evento] ADD CONSTRAINT [Evento_id_tipoEvento_fkey] FOREIGN KEY ([id_tipoEvento]) REFERENCES [dbo].[TipoEvento]([id_tipoEvento]) ON DELETE CASCADE ON UPDATE CASCADE;

-- AddForeignKey
ALTER TABLE [dbo].[ConvocatoriaGeneral] ADD CONSTRAINT [ConvocatoriaGeneral_id_nivelAcademico_fkey] FOREIGN KEY ([id_nivelAcademico]) REFERENCES [dbo].[NivelAcademico]([id_nivelAcademico]) ON DELETE CASCADE ON UPDATE CASCADE;

-- AddForeignKey
ALTER TABLE [dbo].[ConvocatoriaGeneral] ADD CONSTRAINT [ConvocatoriaGeneral_id_evento_fkey] FOREIGN KEY ([id_evento]) REFERENCES [dbo].[Evento]([id_evento]) ON DELETE CASCADE ON UPDATE CASCADE;

-- AddForeignKey
ALTER TABLE [dbo].[ConvocatoriaEspecifica] ADD CONSTRAINT [ConvocatoriaEspecifica_id_aula_fkey] FOREIGN KEY ([id_aula]) REFERENCES [dbo].[Aula]([id_aula]) ON DELETE CASCADE ON UPDATE CASCADE;

-- AddForeignKey
ALTER TABLE [dbo].[ConvocatoriaEspecifica] ADD CONSTRAINT [ConvocatoriaEspecifica_id_evento_fkey] FOREIGN KEY ([id_evento]) REFERENCES [dbo].[Evento]([id_evento]) ON DELETE CASCADE ON UPDATE CASCADE;

-- AddForeignKey
ALTER TABLE [dbo].[Grado] ADD CONSTRAINT [Grado_id_nivelAcademico_fkey] FOREIGN KEY ([id_nivelAcademico]) REFERENCES [dbo].[NivelAcademico]([id_nivelAcademico]) ON DELETE CASCADE ON UPDATE CASCADE;

-- AddForeignKey
ALTER TABLE [dbo].[Aula] ADD CONSTRAINT [Aula_id_grado_fkey] FOREIGN KEY ([id_grado]) REFERENCES [dbo].[Grado]([id_grado]) ON DELETE CASCADE ON UPDATE CASCADE;

-- AddForeignKey
ALTER TABLE [dbo].[UsuarioPadresFamilia] ADD CONSTRAINT [UsuarioPadresFamilia_id_usuario_fkey] FOREIGN KEY ([id_usuario]) REFERENCES [dbo].[Usuario]([id_usuario]) ON DELETE CASCADE ON UPDATE CASCADE;

-- AddForeignKey
ALTER TABLE [dbo].[UsuarioPadresFamilia] ADD CONSTRAINT [UsuarioPadresFamilia_id_padreFamilia_fkey] FOREIGN KEY ([id_padreFamilia]) REFERENCES [dbo].[PadreFamilia]([id_padreFamilia]) ON DELETE CASCADE ON UPDATE CASCADE;

-- AddForeignKey
ALTER TABLE [dbo].[UsuarioAula] ADD CONSTRAINT [UsuarioAula_id_usuario_fkey] FOREIGN KEY ([id_usuario]) REFERENCES [dbo].[Usuario]([id_usuario]) ON DELETE CASCADE ON UPDATE CASCADE;

-- AddForeignKey
ALTER TABLE [dbo].[UsuarioAula] ADD CONSTRAINT [UsuarioAula_id_aula_fkey] FOREIGN KEY ([id_aula]) REFERENCES [dbo].[Aula]([id_aula]) ON DELETE CASCADE ON UPDATE CASCADE;

-- AddForeignKey
ALTER TABLE [dbo].[AsistenciaConvocatoriaEspecifica] ADD CONSTRAINT [AsistenciaConvocatoriaEspecifica_id_usuario_fkey] FOREIGN KEY ([id_usuario]) REFERENCES [dbo].[Usuario]([id_usuario]) ON DELETE CASCADE ON UPDATE CASCADE;

-- AddForeignKey
ALTER TABLE [dbo].[AsistenciaConvocatoriaEspecifica] ADD CONSTRAINT [AsistenciaConvocatoriaEspecifica_id_convocatoriaEspecifica_fkey] FOREIGN KEY ([id_convocatoriaEspecifica]) REFERENCES [dbo].[ConvocatoriaEspecifica]([id_convocatoriaEspecifica]) ON DELETE CASCADE ON UPDATE CASCADE;

-- AddForeignKey
ALTER TABLE [dbo].[AsistenciaConvocatoriaGeneral] ADD CONSTRAINT [AsistenciaConvocatoriaGeneral_id_usuario_fkey] FOREIGN KEY ([id_usuario]) REFERENCES [dbo].[Usuario]([id_usuario]) ON DELETE CASCADE ON UPDATE CASCADE;

-- AddForeignKey
ALTER TABLE [dbo].[AsistenciaConvocatoriaGeneral] ADD CONSTRAINT [AsistenciaConvocatoriaGeneral_id_convocatoriaGeneral_fkey] FOREIGN KEY ([id_convocatoriaGeneral]) REFERENCES [dbo].[ConvocatoriaGeneral]([id_convocatoriaGeneral]) ON DELETE CASCADE ON UPDATE CASCADE;
