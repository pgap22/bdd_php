-- Switch to the target database
USE bdd_proyecto
GO

-- Drop existing tables if needed (be careful!)
-- Example: DROP TABLE IF EXISTS [dbo].[AsistenciaConvocatoriaGeneral]; ... etc.

-- CreateTable with UNIQUEIDENTIFIER and DEFAULT NEWSEQUENTIALID()
CREATE TABLE [dbo].[TipoEvento] (
    [id_tipoEvento] UNIQUEIDENTIFIER NOT NULL CONSTRAINT [DF_TipoEvento_id] DEFAULT NEWSEQUENTIALID(), -- Changed Type and Added Default
    [nombre] NVARCHAR(1000) NOT NULL,
    [tipoAsistencia] NVARCHAR(1000) NOT NULL,
    CONSTRAINT [TipoEvento_pkey] PRIMARY KEY CLUSTERED ([id_tipoEvento])
);

-- CreateTable referencing the new type
CREATE TABLE [dbo].[Evento] (
    [id_evento] UNIQUEIDENTIFIER NOT NULL CONSTRAINT [DF_Evento_id] DEFAULT NEWSEQUENTIALID(), -- Changed Type and Added Default
    [nombre] NVARCHAR(1000) NOT NULL,
    [descripcion] NVARCHAR(1000) NOT NULL,
    [id_tipoEvento] UNIQUEIDENTIFIER NOT NULL, -- Changed Type to match PK
    CONSTRAINT [Evento_pkey] PRIMARY KEY CLUSTERED ([id_evento])
);

-- CreateTable
CREATE TABLE [dbo].[NivelAcademico] (
    [id_nivelAcademico] UNIQUEIDENTIFIER NOT NULL CONSTRAINT [DF_NivelAcademico_id] DEFAULT NEWSEQUENTIALID(), -- Changed Type and Added Default
    [nombre] NVARCHAR(1000) NOT NULL,
    CONSTRAINT [NivelAcademico_pkey] PRIMARY KEY CLUSTERED ([id_nivelAcademico])
);

-- CreateTable
CREATE TABLE [dbo].[ConvocatoriaGeneral] (
    [id_convocatoriaGeneral] UNIQUEIDENTIFIER NOT NULL CONSTRAINT [DF_ConvocatoriaGeneral_id] DEFAULT NEWSEQUENTIALID(), -- Changed Type and Added Default
    [lugar] NVARCHAR(1000) NOT NULL,
    [fecha] DATETIME2 NOT NULL,
    [id_evento] UNIQUEIDENTIFIER NOT NULL, -- Changed Type
    [id_nivelAcademico] UNIQUEIDENTIFIER NOT NULL, -- Changed Type
    CONSTRAINT [ConvocatoriaGeneral_pkey] PRIMARY KEY CLUSTERED ([id_convocatoriaGeneral])
);

-- CreateTable
CREATE TABLE [dbo].[Grado] (
    [id_grado] UNIQUEIDENTIFIER NOT NULL CONSTRAINT [DF_Grado_id] DEFAULT NEWSEQUENTIALID(), -- Changed Type and Added Default
    [nombre] NVARCHAR(1000) NOT NULL,
    [id_nivelAcademico] UNIQUEIDENTIFIER NOT NULL, -- Changed Type
    CONSTRAINT [Grado_pkey] PRIMARY KEY CLUSTERED ([id_grado])
);

-- CreateTable
CREATE TABLE [dbo].[Aula] (
    [id_aula] UNIQUEIDENTIFIER NOT NULL CONSTRAINT [DF_Aula_id] DEFAULT NEWSEQUENTIALID(), -- Changed Type and Added Default
    [seccion] NVARCHAR(1000) NOT NULL,
    [id_grado] UNIQUEIDENTIFIER NOT NULL, -- Changed Type
    CONSTRAINT [Aula_pkey] PRIMARY KEY CLUSTERED ([id_aula])
);


-- CreateTable
CREATE TABLE [dbo].[ConvocatoriaEspecifica] (
    [id_convocatoriaEspecifica] UNIQUEIDENTIFIER NOT NULL CONSTRAINT [DF_ConvocatoriaEspecifica_id] DEFAULT NEWSEQUENTIALID(), -- Changed Type and Added Default
    [lugar] NVARCHAR(1000) NOT NULL,
    [fecha] DATETIME2 NOT NULL,
    [id_evento] UNIQUEIDENTIFIER NOT NULL, -- Changed Type
    [id_aula] UNIQUEIDENTIFIER NOT NULL, -- Changed Type
    CONSTRAINT [ConvocatoriaEspecifica_pkey] PRIMARY KEY CLUSTERED ([id_convocatoriaEspecifica])
);


-- CreateTable
CREATE TABLE [dbo].[Usuario] (
    [id_usuario] UNIQUEIDENTIFIER NOT NULL CONSTRAINT [DF_Usuario_id] DEFAULT NEWSEQUENTIALID(), -- Changed Type and Added Default
    [nombre] NVARCHAR(1000) NOT NULL,
    [apellido] NVARCHAR(1000) NOT NULL,
    [email] NVARCHAR(1000) NOT NULL,
    [password] NVARCHAR(1000) NOT NULL, -- Consider hashing passwords!
    [fecha_creacion] DATETIME2 NOT NULL CONSTRAINT [Usuario_fecha_creacion_df] DEFAULT CURRENT_TIMESTAMP,
    [activo] BIT NOT NULL CONSTRAINT [Usuario_activo_df] DEFAULT 1,
    [rol] NVARCHAR(1000) NOT NULL,
    CONSTRAINT [Usuario_pkey] PRIMARY KEY CLUSTERED ([id_usuario]),
    CONSTRAINT [Usuario_email_key] UNIQUE NONCLUSTERED ([email]) -- Added unique constraint for email
);

-- CreateTable
CREATE TABLE [dbo].[PadreFamilia] (
    [id_padreFamilia] UNIQUEIDENTIFIER NOT NULL CONSTRAINT [DF_PadreFamilia_id] DEFAULT NEWSEQUENTIALID(), -- Changed Type and Added Default
    [dui] NVARCHAR(10) NOT NULL, -- Adjusted size for typical DUI format
    [nombre] NVARCHAR(1000) NOT NULL,
    [apellidos] NVARCHAR(1000) NOT NULL,
    CONSTRAINT [PadreFamilia_pkey] PRIMARY KEY CLUSTERED ([id_padreFamilia]),
    CONSTRAINT [PadreFamilia_dui_key] UNIQUE NONCLUSTERED ([dui])
);

-- CreateTable (Junction Table - Often uses defaults too, or composite keys)
CREATE TABLE [dbo].[UsuarioPadresFamilia] (
    [id_usuarioPadreFamilia] UNIQUEIDENTIFIER NOT NULL CONSTRAINT [DF_UsuarioPadresFamilia_id] DEFAULT NEWSEQUENTIALID(), -- Changed Type and Added Default
    [id_usuario] UNIQUEIDENTIFIER NOT NULL, -- Changed Type
    [id_padreFamilia] UNIQUEIDENTIFIER NOT NULL, -- Changed Type
    CONSTRAINT [UsuarioPadresFamilia_pkey] PRIMARY KEY CLUSTERED ([id_usuarioPadreFamilia]),
    CONSTRAINT [UQ_UsuarioPadresFamilia_UserParent] UNIQUE ([id_usuario], [id_padreFamilia]) -- Ensures a user isn't linked to the same parent twice
);

-- CreateTable (Junction Table)
CREATE TABLE [dbo].[UsuarioAula] (
    [id_usuarioaula] UNIQUEIDENTIFIER NOT NULL CONSTRAINT [DF_UsuarioAula_id] DEFAULT NEWSEQUENTIALID(), -- Changed Type and Added Default
    [id_usuario] UNIQUEIDENTIFIER NOT NULL, -- Changed Type
    [id_aula] UNIQUEIDENTIFIER NOT NULL, -- Changed Type
    CONSTRAINT [UsuarioAula_pkey] PRIMARY KEY CLUSTERED ([id_usuarioaula]),
    CONSTRAINT [UQ_UsuarioAula_UserClass] UNIQUE ([id_usuario], [id_aula]) -- Ensures a user isn't linked to the same class twice
);

-- CreateTable
CREATE TABLE [dbo].[AsistenciaConvocatoriaEspecifica] (
    [id_asistenciaConvocatoriaEspecifica] UNIQUEIDENTIFIER NOT NULL CONSTRAINT [DF_AsistenciaConvocatoriaEspecifica_id] DEFAULT NEWSEQUENTIALID(), -- Changed Type and Added Default
    [estado] NVARCHAR(50) NOT NULL, -- Consider specific states (Presente, Ausente, Justificado) and smaller size
    [fecha_asistencia] DATETIME2 NOT NULL CONSTRAINT [AsistenciaConvocatoriaEspecifica_fecha_asistencia_df] DEFAULT CURRENT_TIMESTAMP,
    [id_usuario] UNIQUEIDENTIFIER NOT NULL, -- Changed Type
    [id_convocatoriaEspecifica] UNIQUEIDENTIFIER NOT NULL, -- Changed Type
    CONSTRAINT [AsistenciaConvocatoriaEspecifica_pkey] PRIMARY KEY CLUSTERED ([id_asistenciaConvocatoriaEspecifica])
);

-- CreateTable
CREATE TABLE [dbo].[AsistenciaConvocatoriaGeneral] (
    [id_asistenciaConvocatoriaGeneral] UNIQUEIDENTIFIER NOT NULL CONSTRAINT [DF_AsistenciaConvocatoriaGeneral_id] DEFAULT NEWSEQUENTIALID(), -- Changed Type and Added Default
    [estado] NVARCHAR(50) NOT NULL, -- Consider specific states (Presente, Ausente, Justificado) and smaller size
    [fecha_asistencia] DATETIME2 NOT NULL CONSTRAINT [AsistenciaConvocatoriaGeneral_fecha_asistencia_df] DEFAULT CURRENT_TIMESTAMP,
    [id_usuario] UNIQUEIDENTIFIER NOT NULL, -- Changed Type
    [id_convocatoriaGeneral] UNIQUEIDENTIFIER NOT NULL, -- Changed Type
    CONSTRAINT [AsistenciaConvocatoriaGeneral_pkey] PRIMARY KEY CLUSTERED ([id_asistenciaConvocatoriaGeneral])
);

-- Add Foreign Key Constraints (referencing the UNIQUEIDENTIFIER columns)
ALTER TABLE [dbo].[Evento] ADD CONSTRAINT [Evento_id_tipoEvento_fkey] FOREIGN KEY ([id_tipoEvento]) REFERENCES [dbo].[TipoEvento]([id_tipoEvento]) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE [dbo].[ConvocatoriaGeneral] ADD CONSTRAINT [ConvocatoriaGeneral_id_nivelAcademico_fkey] FOREIGN KEY ([id_nivelAcademico]) REFERENCES [dbo].[NivelAcademico]([id_nivelAcademico]) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE [dbo].[ConvocatoriaGeneral] ADD CONSTRAINT [ConvocatoriaGeneral_id_evento_fkey] FOREIGN KEY ([id_evento]) REFERENCES [dbo].[Evento]([id_evento]) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE [dbo].[ConvocatoriaEspecifica] ADD CONSTRAINT [ConvocatoriaEspecifica_id_aula_fkey] FOREIGN KEY ([id_aula]) REFERENCES [dbo].[Aula]([id_aula]) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE [dbo].[ConvocatoriaEspecifica] ADD CONSTRAINT [ConvocatoriaEspecifica_id_evento_fkey] FOREIGN KEY ([id_evento]) REFERENCES [dbo].[Evento]([id_evento]) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE [dbo].[Grado] ADD CONSTRAINT [Grado_id_nivelAcademico_fkey] FOREIGN KEY ([id_nivelAcademico]) REFERENCES [dbo].[NivelAcademico]([id_nivelAcademico]) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE [dbo].[Aula] ADD CONSTRAINT [Aula_id_grado_fkey] FOREIGN KEY ([id_grado]) REFERENCES [dbo].[Grado]([id_grado]) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE [dbo].[UsuarioPadresFamilia] ADD CONSTRAINT [UsuarioPadresFamilia_id_usuario_fkey] FOREIGN KEY ([id_usuario]) REFERENCES [dbo].[Usuario]([id_usuario]) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE [dbo].[UsuarioPadresFamilia] ADD CONSTRAINT [UsuarioPadresFamilia_id_padreFamilia_fkey] FOREIGN KEY ([id_padreFamilia]) REFERENCES [dbo].[PadreFamilia]([id_padreFamilia]) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE [dbo].[UsuarioAula] ADD CONSTRAINT [UsuarioAula_id_usuario_fkey] FOREIGN KEY ([id_usuario]) REFERENCES [dbo].[Usuario]([id_usuario]) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE [dbo].[UsuarioAula] ADD CONSTRAINT [UsuarioAula_id_aula_fkey] FOREIGN KEY ([id_aula]) REFERENCES [dbo].[Aula]([id_aula]) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE [dbo].[AsistenciaConvocatoriaEspecifica] ADD CONSTRAINT [AsistenciaConvocatoriaEspecifica_id_usuario_fkey] FOREIGN KEY ([id_usuario]) REFERENCES [dbo].[Usuario]([id_usuario]) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE [dbo].[AsistenciaConvocatoriaEspecifica] ADD CONSTRAINT [AsistenciaConvocatoriaEspecifica_id_convocatoriaEspecifica_fkey] FOREIGN KEY ([id_convocatoriaEspecifica]) REFERENCES [dbo].[ConvocatoriaEspecifica]([id_convocatoriaEspecifica]) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE [dbo].[AsistenciaConvocatoriaGeneral] ADD CONSTRAINT [AsistenciaConvocatoriaGeneral_id_usuario_fkey] FOREIGN KEY ([id_usuario]) REFERENCES [dbo].[Usuario]([id_usuario]) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE [dbo].[AsistenciaConvocatoriaGeneral] ADD CONSTRAINT [AsistenciaConvocatoriaGeneral_id_convocatoriaGeneral_fkey] FOREIGN KEY ([id_convocatoriaGeneral]) REFERENCES [dbo].[ConvocatoriaGeneral]([id_convocatoriaGeneral]) ON DELETE CASCADE ON UPDATE CASCADE;

GO