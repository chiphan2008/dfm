/**
 * SMARTBUS API
 * No description provided (generated by Swagger Codegen https://github.com/swagger-api/swagger-codegen)
 *
 * OpenAPI spec version: 1.0.0
 * 
 *
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen.git
 * Do not edit the class manually.
 */

/*
 * ModelFirmware.h
 * 
 * 
 */

#ifndef ModelFirmware_H_
#define ModelFirmware_H_

#include <QJsonObject>


#include <QDateTime>
#include <QString>

#include "SWGObject.h"

namespace api {

class ModelFirmware: public SWGObject {
public:
    ModelFirmware();
    ModelFirmware(QString* json);
    virtual ~ModelFirmware();
    void init();
    void cleanup();

    QString asJson ();
    QJsonObject* asJsonObject();
    void fromJsonObject(QJsonObject &json);
    ModelFirmware* fromJson(QString &jsonString);

    qint64 getId();
    void setId(qint64 id);

    qint64 getDeviceModelId();
    void setDeviceModelId(qint64 device_model_id);

    QString* getServerIp();
    void setServerIp(QString* server_ip);

    QString* getUsername();
    void setUsername(QString* username);

    QString* getPassword();
    void setPassword(QString* password);

    QString* getPath();
    void setPath(QString* path);

    qint32 getVersion();
    void setVersion(qint32 version);

    QString* getFilename();
    void setFilename(QString* filename);

    QDateTime* getCreatedAt();
    void setCreatedAt(QDateTime* created_at);

    QDateTime* getUpdatedAt();
    void setUpdatedAt(QDateTime* updated_at);


private:
    qint64 id;
    qint64 device_model_id;
    QString* server_ip;
    QString* username;
    QString* password;
    QString* path;
    qint32 version;
    QString* filename;
    QDateTime* created_at;
    QDateTime* updated_at;
};

}

#endif /* ModelFirmware_H_ */