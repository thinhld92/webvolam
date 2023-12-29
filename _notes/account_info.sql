USE [SHXT2]
GO

/****** Object:  Table [dbo].[Account_Info]    Script Date: 12/09/2023 10:17:44 ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[Account_Info](
	[iid] [bigint] IDENTITY(1,1) NOT NULL,
	[cAccName] [varchar](32) NOT NULL,
	[cPassWord] [varchar](99) NOT NULL,
	[cSecPassword] [varchar](99) NULL,
	[cRealName] [nvarchar](50) NULL,
	[dBirthDay] [datetime] NULL,
	[cArea] [varchar](60) NULL,
	[cIDNum] [varchar](30) NULL,
	[dRegDate] [datetime] NULL,
	[cPhone] [varchar](50) NULL,
	[iClientID] [bigint] NULL,
	[dLoginDate] [varchar](20) NULL,
	[dLogoutDate] [varchar](20) NULL,
	[iTimeCount] [tinyint] NULL,
	[cQuestion] [varchar](250) NULL,
	[cAnswer] [varchar](250) NULL,
	[cSex] [varchar](4) NULL,
	[cDegree] [varchar](16) NULL,
	[cEMail] [varchar](128) NULL,
	[iLock] [int] NULL,
	[gCode] [int] NULL,
	[nMac] [int] NULL,
	[remember_token] [nvarchar](100) NULL,
 CONSTRAINT [PK_Account_Info] PRIMARY KEY CLUSTERED 
(
	[iid] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO

ALTER TABLE [dbo].[Account_Info] ADD  CONSTRAINT [DF_Account_Info_dRegDate]  DEFAULT (getdate()) FOR [dRegDate]
GO

ALTER TABLE [dbo].[Account_Info] ADD  CONSTRAINT [DF__Account_I__iGame__77BFCB91]  DEFAULT ((0)) FOR [iClientID]
GO

ALTER TABLE [dbo].[Account_Info] ADD  CONSTRAINT [DF_Account_Info_iLock]  DEFAULT ((0)) FOR [iLock]
GO

ALTER TABLE [dbo].[Account_Info] ADD  CONSTRAINT [DF_Account_Info_gCode]  DEFAULT ((0)) FOR [gCode]
GO


