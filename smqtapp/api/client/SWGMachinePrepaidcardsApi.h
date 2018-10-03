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

#ifndef _SWG_SWGMachinePrepaidcardsApi_H_
#define _SWG_SWGMachinePrepaidcardsApi_H_

#include "SWGHttpRequest.h"

#include "ModelPrepaidCard.h"
#include "ModelPrepaidCardForm.h"

#include <QObject>

namespace api {

class SWGMachinePrepaidcardsApi: public QObject {
    Q_OBJECT

public:
    SWGMachinePrepaidcardsApi();
    SWGMachinePrepaidcardsApi(QString host, QString basePath);
    ~SWGMachinePrepaidcardsApi();

    QString host;
    QString basePath;
    QMap<QString, QString> defaultHeaders;

    void machineCreatePrepaidcard(ModelPrepaidCardForm body);
    
private:
    void machineCreatePrepaidcardCallback (HttpRequestWorker * worker);
    
signals:
    void machineCreatePrepaidcardSignal(ModelPrepaidCard* summary);
    
    void machineCreatePrepaidcardSignalE(ModelPrepaidCard* summary, QNetworkReply::NetworkError error_type, QString& error_str);
    
    void machineCreatePrepaidcardSignalEFull(HttpRequestWorker* worker, QNetworkReply::NetworkError error_type, QString& error_str);
    
};

}
#endif